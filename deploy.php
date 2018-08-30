<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name

set_time_limit(0);
set('application', 'aurora');

// 指定你的代码所在的服务器 SSH 地址，请不要使用 https 方式。
set('repository', 'git@github.com:AuroraLZDF/aurora.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', ['public']);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('114.67.141.115')
    ->user('deployer') // 这里填写 deployer 
      // 并指定公钥的位置
    ->identityFile('~/.ssh/deployerkey')
    // 指定项目部署到服务器上的哪个目录
    ->set('deploy_path', '/var/www/html/aurora');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

