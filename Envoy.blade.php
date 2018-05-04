@servers(['web' => ['127.0.0.1']])

@task('deploy', ['on' => 'web'])
ls -la
@endtask
