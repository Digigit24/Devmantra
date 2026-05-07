import os
import re

files_to_process = ['blog.html', 'service.html', 'contact.html']

for file_name in files_to_process:
    file_path = os.path.join('e:/office-work/Devmantra', file_name)
    if os.path.exists(file_path):
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()

        # Regex to find <header> ... </header>
        # Needs to match multiline
        new_content, count = re.subn(r'<header>.*?</header>', '<script src="assets/js/header.js"></script>', content, flags=re.DOTALL)
        
        if count > 0:
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f'Replaced header in {file_name}')
        else:
            print(f'No <header> element found in {file_name}')
