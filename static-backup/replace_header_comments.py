import os
import re

files_to_process = ['blog.html', 'service.html', 'contact.html']

for file_name in files_to_process:
    file_path = os.path.join('e:/office-work/Devmantra', file_name)
    if os.path.exists(file_path):
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()

        # Regex to find <!-- header area start --> ... <!-- header area end -->
        # Using DOTALL so .* matches newlines
        new_content, count = re.subn(r'<!-- header area start -->.*?<!-- header area end -->', '<script src="assets/js/header.js"></script>', content, flags=re.DOTALL)
        
        # Sometimes there are multiple start/end comments, we want the outermost? Or maybe just replace all of them with the single script if they are consecutive?
        # Actually, let's just make sure it's doing what we want.
        if count > 0:
            # Let's clean up any double scripts if there were multiple blocks
            new_content = re.sub(r'(<script src="assets/js/header\.js"></script>\s*)+', '<script src="assets/js/header.js"></script>\n', new_content)
            
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f'Replaced header in {file_name} (found {count} matches)')
        else:
            print(f'No header comments found in {file_name}')
