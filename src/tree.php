<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Tree</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Directory Tree</h1>
        <div id="directoryTree"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const data = <?php
                function scanDirRecursive($dir, $baseDir = '') {
                    $result = [];
                    $items = scandir($dir);
                    foreach ($items as $item) {
                        if ($item == '.' || $item == '..') {
                            continue;
                        }
                        $path = $dir . DIRECTORY_SEPARATOR . $item;
                        $relativePath = ltrim($baseDir . DIRECTORY_SEPARATOR . $item, DIRECTORY_SEPARATOR);
                        if (is_dir($path)) {
                            $result[$item] = scanDirRecursive($path, $relativePath);
                        } else {
                            $result[] = $relativePath;
                        }
                    }
                    return $result;
                }

                $rootDir = __DIR__;
                $directoryTree = scanDirRecursive($rootDir);
                echo json_encode($directoryTree);
            ?>;

            const treeContainer = document.getElementById('directoryTree');
            treeContainer.appendChild(createTree(data));

            function createTree(data) {
                const ul = document.createElement('ul');
                ul.style.display = 'none'; // Initially hide all directories

                for (const key in data) {
                    if (typeof data[key] === 'object') {
                        const li = document.createElement('li');
                        li.innerHTML = `<span class="folder"><i class="fa-solid fa-folder"></i> ${key}</span>`;
                        li.appendChild(createTree(data[key]));
                        ul.appendChild(li);
                    } else {
                        const li = document.createElement('li');
                        const fileName = data[key];
                        const fileExtension = fileName.split('.').pop();
                        let iconClass = 'fa-solid fa-code';

                        if (fileExtension === 'php') {
                            iconClass = 'fa-brands fa-php';
                        } else if (fileExtension === 'html') {
                            iconClass = 'fa-brands fa-html5';
                        } else if (fileExtension === 'css') {
                            iconClass = 'fa-brands fa-css3';
                        } else if (['png', 'jpg', 'jpeg', 'gif', 'bmp'].includes(fileExtension)) {
                            iconClass = 'fa-solid fa-image';
                        }

                        li.innerHTML = `<a href="${fileName}" class="file"><i class="${iconClass}"></i> ${fileName.split('/').pop()}</a>`;
                        ul.appendChild(li);
                    }
                }

                return ul;
            }

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('folder') || e.target.parentElement.classList.contains('folder')) {
                    const folderElement = e.target.classList.contains('folder') ? e.target : e.target.parentElement;
                    const nextUl = folderElement.nextElementSibling;
                    const icon = folderElement.querySelector('i');
                    if (nextUl.style.display === 'none' || nextUl.style.display === '') {
                        nextUl.style.display = 'block';
                        folderElement.classList.add('open');
                        icon.classList.remove('fa-folder');
                        icon.classList.add('fa-folder-open');
                    } else {
                        nextUl.style.display = 'none';
                        folderElement.classList.remove('open');
                        icon.classList.remove('fa-folder-open');
                        icon.classList.add('fa-folder');
                    }
                }
            });

            // Initially display the root directory
            const rootUl = treeContainer.querySelector('ul');
            if (rootUl) {
                rootUl.style.display = 'block';
            }
        });
    </script>
</body>
</html>
