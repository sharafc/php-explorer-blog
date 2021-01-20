# Learning PHP with a blog

Initial version needed to be done with some not-standard compliant coding conventions and debugging methodology which I did only partially use. Rest should be PSR compliant.

## Prospect

In the future:
* want to change everything completely to a more modular approach and PSR
* switch everything to OOP
* use [PSR](https://www.php-fig.org/psr) compliant methodology

### Updates

#### Version 2:
- Added a simple logger functionality (not [PSR-3](https://www.php-fig.org/psr/psr-3/) compliant) which is able to write to the console instead of writing in the DOM
- Added a very simple control, model, view mechanism and routing (dispatching). Therefore the overall link structure changed and setting up a vhost on a local dev environment is recommended:

```bash
NameVirtualHost *:80
<VirtualHost *:80>
 DocumentRoot <your htdocs>
 ServerName localhost
</VirtualHost>

<VirtualHost *:80>
 DocumentRoot <your htdocs><yourprojectname>
 ServerName <yourprojectname>.localhost
</VirtualHost>
```

#### Version 1:
Training compatible structure and functionality. No separation of concerns, lots of "debugging" messages in the frontend.
Treading on common ground to pass the evaluation, although I know that it is not PSR compliant etc. pp.
