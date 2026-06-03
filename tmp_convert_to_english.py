from pathlib import Path
import re

files = ['index.php', 'login.php', 'register.php', 'contact.php', 'dashboard.php', 'order.php']

for fname in files:
    path = Path(fname)
    if not path.exists():
        print('skip', fname, 'missing')
        continue
    text = path.read_text(encoding='utf-8')
    text = text.replace('<html lang="ro">', '<html lang="en">')
    text = text.replace('<html lang="ru">', '<html lang="en">')
    text = text.replace('<html lang="en">', '<html lang="en">')

    # Replace data-en visible text on simple tags with no child elements
    pattern = re.compile(r'(<(?P<tag>[a-zA-Z0-9]+)(?P<attrs>[^>]*?)\sdata-en="(?P<en>[^"]+)"(?P<rest>[^>]*?)>)(?P<text>[^<]*)(</(?P=tag)>)')

    def replace_visible(m):
        if '<' in m.group('text') or '>' in m.group('text'):
            return m.group(0)
        return f'<{m.group("tag")}{m.group("attrs")}{m.group("rest")}>{m.group("en")}</{m.group("tag")}> '

    text = pattern.sub(replace_visible, text)

    # Replace placeholders with English if provided
    pattern_ph = re.compile(r'placeholder="[^\"]*"([^>]*?\sdata-en-placeholder="(?P<en>[^"]+)")')

    def replace_placeholder(m):
        rest = re.sub(r'\sdata-(?:ro|ru|en)-placeholder="[^"]*"', '', m.group(1))
        return f'placeholder="{m.group("en")}"{rest}'

    text = pattern_ph.sub(replace_placeholder, text)

    # Remove all language-specific data attributes
    text = re.sub(r'\sdata-(?:ro|ru|en)(?:-[a-zA-Z]+)?="[^"]*"', '', text)

    # Remove language toggle button from pages
    text = re.sub(r'\s*<button id="langToggle"[^>]*>.*?</button>\s*', '', text, flags=re.S)

    path.write_text(text, encoding='utf-8')
    print('processed', fname)
