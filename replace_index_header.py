import os
import re

file_name = 'index.html'
file_path = os.path.join('e:/office-work/Devmantra', file_name)

if os.path.exists(file_path):
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Regex to find <header>...</header>
    new_content, count = re.subn(r'<header>\s*<!-- header area start -->.*?<!-- header area end -->\s*</header>', '<script src="assets/js/header.js"></script>', content, flags=re.DOTALL)
    
    if count > 0:
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f'Replaced header in {file_name} (found {count} matches)')
    else:
        print(f'No <header> element found in {file_name}')
