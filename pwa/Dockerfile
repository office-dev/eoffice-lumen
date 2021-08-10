# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target


# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact
ARG NODE_VERSION=14

# "common" stage
FROM node:${NODE_VERSION}-alpine AS eoffice_pwa_common

EXPOSE 3000
EXPOSE 8080

WORKDIR /usr/src/pwa

ENV NEXT_TELEMETRY_DISABLED 1

VOLUME /usr/src/pwa

# prevent the reinstallation of node modules at every changes in the source code
RUN npm install

# "development" stage
# depends on the "common" stage above
FROM eoffice_pwa_common AS eoffice_pwa_dev

CMD ["npm", "run", "hot"]


# "build" stage
# depends on the "common" stage above
FROM eoffice_pwa_common AS eoffice_pwa_prod

ENV NODE_ENV production

CMD ["npm", "run", "production"]
