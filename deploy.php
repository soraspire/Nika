<?php

namespace Deployer;

require 'recipe/laravel.php';

set('application', 'nika');
set('repository', 'git@github.com:soraspire/nika.git');
set('branch', 'candidate');
set('git_tty', true);

set('keep_releases', 2);

add('shared_files', ['.env']);
add('shared_dirs', ['storage']);
add('writable_dirs', ['storage', 'bootstrap/cache']);

host('production')
    ->setHostname('nika-prod')
    ->setRemoteUser('deployer')
    ->set('deploy_path', '/var/www/nika');

after('deploy:failed', 'deploy:unlock');
