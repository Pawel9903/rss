# RSS
Console application created in PHP to retrieve RSS\Atom data and save them to a CSV file. 

## Install
### Via docker
1. `git clone git@github.com:Pawel9903/rss.git`
2. `cd rss`
3. execute the command `./docker.sh upd`
4. install vendors by executing command `./docker.sh composer install`

### Without docker
1. `git clone git@github.com:Pawel9903/rss.git`
2. `cd rss/app`
4. install vendors by executing command `composer install`

### Available commands
- `csv:simple URL PATH` - get RSS / Atom data from url and save it to PATH.csv file specified by PATH path. This action overwrites the old data.
- `csv:extended URL PATH` - get RSS / Atom data from a URL and appending it to the PATH.csv file specified by the PATH path.


## Usuage
If you are using docker you can run commands with `run.sh`. For example, the command `./run.sh csv:simple https://blog.nationalgeographic.org/rss` will save the csv file to the specified path.
Remember that when using docker, file is saved in the container. You can also invoke commands with `php console.php` in the `/app/src` directory.

## Run Unit Tests
The command is used to invoke the tests `./docker.sh phpunit` or `./phpunit.sh` in `/app` dir.
