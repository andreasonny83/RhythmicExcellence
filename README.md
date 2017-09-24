# RhythmicExcellence

## This is a WordPress project running on www.rhythmicExcellence.lonon

* The project is developed to run on three different environment (dev, stage and production)

## Wordpress Capistrano Boilerplate

This project is based on [Wordpress Capistrano Boilerplate](https://github.com/SonnyWebDesign/Wordpress-Capistrano-Boilerplate) for automate the deployment process.

## Installation

First clone this project on your local machine with

```sh
$ git clone --recursive https://github.com/andreasonny83/RhythmicExcellence.git
```

### Install the Ruby dependencies

We are going to use [Bundler](http://bundler.io/). Bundler provides a consistent environment for Ruby projects by tracking and installing the exact gems and versions that are needed.
If you don't have Bundler already installed in your machine, open a terminal window and run this command:

```sh
$ gem install bundler
```

or, if you are on El Capitan:

```sh
$ gem install bundler -n /usr/local/bin
```

Then, from inside your project folder, run:

```sh
$ bundle install
```

This will install all the Gem dependencies required by Capistrano

### Install the Node dependencies

Then install all the node dependencies with

```sh
$ npm install
```

Or using Yarn with

```sh
$ yarn
```

## SSH

Capistrano deploys using SSH. Thus, you must be able to SSH (ideally with keys and ssh-agent) from the deployment system to the destination system for Capistrano to work.

You can test this using a ssh client, e.g. `ssh myuser@destinationserver`. If you cannot connect at all, you may need to set up the SSH server or resolve firewall/network issues.

If a password is required when you log in, you may need to set up SSH keys. [GitHub has a good tutorial](https://help.github.com/articles/generating-an-ssh-key/) on creating these (follow steps 1 through 3). You will need to add your public key to ~/.ssh/authorized_keys on the destination server as the deployment user (append on a new line).

## WordPress as a submodule

This project uses WordPress as a git submodule which is super handy and helps keep your structure more modular.
You can simply switch between different WordPress versions from Git.
Enter inside the wordpress folder present in the app root directory, then run:

```sh
$ git checkout <WordPress version>

# eg.
$ git checkout 4.4.2
```

Wordpress should be already present in your project directory as a submodule. Reach the WP folder with `cd wordpress` and fetch all the latest tags with `git fetch --tags && git tag`.
Now you can simply select the WordPress version you want to run in your project with `git checkout {version_number}` (eg. `git checkout 4.4.2`)

## Project Settings

Great, now you're almost ready for rendering your WordPress website.
First we need a database.
Create or clone your local database and configure your `config.php` with your settings.

`config.php` will be only used on your local environment and won't we deploy to your server folder. We already mentioned that inside the `.gitignore` file for you :sunglasses:

Inside your `wp-config.php` we already set some constants to a default value like `DB_CHARSET`, `DB_COLLATE` and `WPLANG`. Feel free to edit this file with your custom settings.

In the same file, there is a section called `Custom Directory`, here we tell WordPress our new file structure.
We also try to include a `config.php`. This will contain your server database configuration and will be stored inside your server `shared` folder from where Capistrano will create a symlink inside your project folder so you don't need to do it manually.

Now, if you have correctly configured your database and your `config.php` you should be able to run your local environment using some PHP and MySQL tool like MAMP.

#### Be careful

We already defined a `.httaccess` sample file for you to use. Because the `RewriteBase` is set to `/`, your website is not supposed to run from a subfolder (eg. localhost or www.mywebsite.com). If your website is hosted on a subfolder like `localhost:8888/my_wordpress_website/` or `www.mywebsite.com/my_wordpress_website` you will need to change your `.httaccess` file defining your correct address.

## Capistrano

Now that we have completed the project structure, we can start thinking about the deployment process with Capistrano.

By default, this boilerplate allows you to run `bundle exec cap {environment_name} deploy` to 2 different environments: `stage` and `prod` where stage will deploy your `develop` branch and prod is pointing to your `master` one. All the configuration for the different environments are stored inside the correspondent `.rb` file inside your `config/deploy` folder.

##### cofig/deploy.rb

This is the core of Capistrano. In here you can set up all the variables Capistrano will need for deploying your project.

* **application** : your application name. This will be used for creating a temporary folder on your server in where cloning the repository.
* **user** : the user that will be used for ssh into your server and creating the deploy folder on it.
* **server_name** : your server URL name.
* **repo_url** : your Git repository url.
* **public_html** : The public folder from where Capistrano will create a symbolic link to your deployed release.
* **git_strategy** : This is used for deploy all the Git submodules related to the repository (like WordPress in this example).
* **tmp_dir** : the server path in where you want Capistrano to clone your repository (eg. /home/my_user_name/tmp ). Note: This should be outside of your `public_html` folder as we don't want to be a public access folder.

##### config/deploy/stage.rb and prod.rb

This is relative to the environment you want to deploy.
Feel free to create as many `.rb` files as you want inside this folder. You can then simply deploy one of them calling `bundle exec cap {filename} deploy` (eg. `bundle exec cap stage deploy`).

* **deploy_dir** : the folder in where you want to deploy your project.
* **deploy_to** : This is more specific to the current environment. Usually this is a subfolder of deploy_dir.
* **application_name** : this will be used for creating the symbolic link in your public folder
* **linked_files** : these files will be symlinked from your shared folder inside your project folder
* **branch** : the git branch you want to deploy

## Server side

Because the `linked_files` array is pointing to `config.php` and `.htaccess`, you will need to upload these 2 files inside your shared folder on your server before deploying your project, otherwise an error will be triggered and the deploy will be cancelled.
You can copy the .htaccess from this project inside your `shared` folder and also create a copy of `prod.config.php` to use as your deployment config.php.
The shared folder will be created inside your `deploy_to` path followed by `shared` (eg. home/my_user/capistrano/rhythmicexcellence/stage/shared)

## Development

This project uses `Gulp` for generating new theme versions.
Install NodeJS, NPM, then run `npm install` to install all the project dependencies.

Start the development mode with

```sh
$ npm start
```

from inside the project root directory to compile and watch your `RhythmicExcellence_dev` directory.

Once done, compile a distribution version of the theme running

```sh
$ npm run build
```

## Deployment

To deploy into the production environment straight away,
just use the npm deploy task

```sh
$ npm run deploy
```

Remember to push your local changes to master before deploying as Capistrano will
pull the latestes mater changes into your remote server when triggered.

**This task will:**

* Install all the Bower dependencies needed
* Build a brand new version of the project
* Deploy the generated build version into your production environment using Capistrano

## Contributing

1. Fork it!
1. Create your feature branch: `git checkout -b my-new-feature`
1. Commit your changes: `git commit -m 'Add some feature'`
1. Push to the branch: `git push origin my-new-feature`
1. Submit a pull request

## License

The code and the documentation are released under the [MIT License](http://andreasonny.mit-license.org).

## Changelog

## 1.3.0
* Photo gallery using [FooGallery](https://en-gb.wordpress.org/plugins/foogallery/) WordPress plugin
* `uploads` folder updated
* `gallery` CSS file implemented to overwrite FooGallery rules
* JS Code Styleguide fixed
* Capistrano `clean_folder` task updated
* Documentation updated<br>
2016.05.15

## 1.2.2
* Responsive css hotfixed<br>
2016.03.10

## 1.2.1
* Some responsive css fixed
* manifest.json updated<br>
2016.03.10

## 1.2.0
* Gulp task introduced
* Performance optimization<br>
2016.03.10

## 1.1.5
* Introducing Wordpress Capistrano Boilerplate
* New Gulp task runner in substitution of Grunt<br>
2016.02.21

## 1.1.4
* minor improvements and bug fixes<br>
2016.02.05

## 1.1.3
* Code optimisation
* Rewrote Grunt script
* CSS and JavaScript minimised and compressed
* Image optimised and removed the old unused ones
* Security improved on server side and with .htaccess
* Map module is now initialised only where a map is preset to avoid generating unwanted js errors on the page
* Footer share button redesigned for a better responsive design support
* Single page menu
* Responsive menu
* Timetable renamed to Calendar
* Removed the default link on media images attached on WordPress
* Code optimised around the website
* Other minor improvement

## 1.0.1
* Grunt and SASS implementation
* From this version, the project will use Grunt and SASS
* Please, read the Grunt section in this file for more informations

## 1.0
* Initial commit
