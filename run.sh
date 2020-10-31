#!/usr/bin/env bash

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
    echo -e "Command: ${LGREEN}${composeCommand}${NC}\n"
    eval ${composeCommand}
    echo -e "\nCommand: ${LGREEN}${composeCommand}${NC}"
}

dockerExec() {
    dockerCommand exec $@
}

dockerExecPhp() {
    dockerExec php-fpm $@
}

dockerExecConsole() {
    dockerExecPhp php ./src/console.php $@
}

secondCommand=${@:1}

    dockerExecConsole ${secondCommand}
exit 0