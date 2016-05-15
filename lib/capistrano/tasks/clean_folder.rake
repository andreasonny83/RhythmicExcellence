desc 'Clean project folder from unwanted files'
task :clean_folder do
  on roles(:all) do
    # delete all the development files
    execute "find #{fetch(:release_path)}/ find -name 'dev.*' | xargs -I {} rm -rf '{}';"
    # delete all the capistrano, ruby and other files we don't want to deploy to the live environment
    execute "find #{fetch(:release_path)}/ -maxdepth 1 -name 'Capfile'"\
                                                  " -o -name 'Gemfile*'"\
                                                  " -o -name 'README.md'"\
                                                  " -o -name 'REVISION'"\
                                                  " -o -name 'LICENSE'"\
                                                  " -o -name '.editorconfig'"\
                                                  " -o -name '.babelrc'"\
                                                  " -o -name '.bowerrc'"\
                                                  " -o -name '.jscsrc'"\
                                                  " -o -name '.jshintrc'"\
                                                  " -o -name 'bower.json'"\
                                                  " -o -name 'package.json'"\
                                                  " -o -name 'gulpfile.babel.js'"\
                                                  " -o -type d -name '.bundle'"\
                                                  " -o -type d -name 'lib'"\
                                                  " -o -type d -name 'config'"\
                                                  " | xargs -I {} rm -rf '{}';"
    # Remove the development theme folder
    execute "rm -Rf #{fetch(:release_path)}/content/themes/RhythmicExcellence_dev/";
  end
end
