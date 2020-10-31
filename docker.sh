#!/usr/bin/env bash

GREEN='\e[92m'
NC='\033[0m' # No Color

exportVars() {
    export DEV_PATH=`pwd`
    export APP_PATH=${DEV_PATH}/app
    export CURRENT_UID=$(id -u)
    export CURRENT_GID=$(id -g)
    export USER_NAME=$(id -un)
    export GROUP_NAME=$(id -gn)
    export CURRENT_USER=${CURRENT_UID}:${CURRENT_GID}
}

dockerCommand() {
    exportVars
    command=$@
    composeCommand="docker-compose ${command}"
    echo -e "Command: ${GREEN}${composeCommand}${NC}\n"
    eval ${composeCommand}
    echo -e "\nCommand: ${GREEN}${composeCommand}${NC}"
}

dockerUp() {
    dockerCommand up $@
}

dockerUpD() {
    dockerUp -d $@
}

dockerUpForce() {
    dockerUpD --force-recreate $@
}

dockerDown() {
    dockerCommand down $@
}

dockerBuild() {
    dockerCommand build $@
}

dockerLogs() {
    dockerCommand logs $@
}

dockerExec() {
    dockerCommand exec $@
}

dockerExecPhp() {
    dockerExec php-fpm $@
}

dockerPphComposer() {
    dockerExecPhp composer $@
}

runTest() {
    dockerExecPhp './vendor/bin/phpunit test' $@
}

secondCommand=${@:2}

help="Commands:
         upd           - run containers in background,
         up            - run containers,
         up-force      - force recreate containers,
         down          - down containers,
         build         - build containers,
         logs          - containers logs,
         exec          - exec containers example: ./docker.sh exec nginx sh,
         e-php         - exec php-fpm,
         composer      - call php composer,
         phpunit       - run PHPUnit tests"

case "$1" in
    "")
    echo "${help}" >&2
    exit 1
    ;;
    upd)
        dockerUpD ${secondCommand}
        ;;
    up)
        dockerUp ${secondCommand}
        ;;
    up-force)
        dockerUpForce ${secondCommand}
        ;;
    down)
        dockerDown ${secondCommand}
        ;;
    build)
        dockerBuild ${secondCommand}
        ;;
    logs)
        dockerLogs -f ${secondCommand}
        ;;
    exec)
        dockerExec ${secondCommand}
        ;;
    e-php)
        dockerExecPhp ${secondCommand}
        ;;
    composer)
        dockerPphComposer ${secondCommand}
        ;;
    phpunit)
        runTest ${secondCommand}
        ;;
    *)
        echo "${help}" >&2
        exit 1
        ;;
esac

exit 0
