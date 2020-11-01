# lifetrack-technical-test

## System Requirements
- PHP 7+
- Composer

1. Clone this repository
2. Inside the cloned repository folder run `composer dump-autoload` - I autloaded my classes with composer so this step is necessary
3. Set up a vhost and point it to the `public` directory of this folder
4. View in browser via vhost.

If you do not wish to setup a vhost, open `public/src/index.html` and update the `<base id="base_tag" href="/">` accordingly

## Docker

Alternatively you may use this docker [image](https://hub.docker.com/r/prymag/lifetracker-test)

`docker pull prymag/lifetracker-test:latest`

then

`docker run -d -p 4000:80 prymag/lifetracker-test`

finally visit `http://localhost:4000` on your browser