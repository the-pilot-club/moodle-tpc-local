# moodle-helper-plugin

This plugin is designed to be the bridge between TPC Flight School Website and other systems.

## Installation

The installation of this plugin is based on your own specs for moodle. 


## Configuation

Those who wish to use this plugin need to set the follow properties:

### ``Site Admin -> Local Plugins -> TPC``

The following needs to be set within the plugin settings page to ensure proper usage of the http request:

``Webhook URL``

This will set the URL at which the http request is made.

``Webhook secret``

This will set the API key for the request within the event handler allowing the http request to go though.

``quiz ID``

This sets the quiz ID so that not every quiz is being used for this plugin, only the P0 exam that is in use.

## Contributing

If you would like to contribute, you may do so by cloning the repo and submitting a pull request with any changes you want to make.

# moodle-tpc-local
