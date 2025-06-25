<script setup lang="ts">
import ServerBrowser from '@/components/server-browser/ServerBrowser.vue';
import { ElDewritoServer } from '@/models/ElDewritoServer';
import { ValidationError } from '@/exceptions/ValidationError';
import { Head } from '@inertiajs/vue3';
import 'bulma/css/bulma.min.css';
import { onMounted, ref } from 'vue';

interface Props {
    plebBrowserApi: string;
}

const props = defineProps<Props>();

const playerCount = ref(0);
const serverCount = ref(0);
const servers = ref<ElDewritoServer[]>([]);

const showBrowser = ref(false);
const browserStatus = ref('Loading...');

function fetchPlebBrowser() {
    fetch(props.plebBrowserApi)
        .then((response) => response.json())
        .then((data) => {
            updateCounts(data.count);

            const serverArray: object[] = [];

            Object.entries(data.servers).forEach(([ip, server]) => {
                serverArray.push({
                    ip: ip,
                    name: server.name,
                    port: server.port,
                    fileServerPort: server.fileServerPort,
                    hostPlayer: server.hostPlayer,
                    sprintState: server.sprintState,
                    sprintUnlimitedEnabled: server.sprintUnlimitedEnabled,
                    assassinationEnabled: server.assassinationEnabled,
                    voteSystemType: server.voteSystemType,
                    teams: server.teams,
                    map: server.map,
                    mapFile: server.mapFile,
                    variant: server.variant,
                    variantType: server.variantType,
                    status: server.status,
                    numPlayers: server.numPlayers,
                    maxPlayers: server.maxPlayers,
                    modCount: server.modCount,
                    modPackageName: server.modPackageName,
                    modPackageAuthor: server.modPackageAuthor,
                    modPackageHash: server.modPackageHash,
                    modPackageVersion: server.modPackageVersion,
                    xnkid: server.xnkid,
                    xnaddress: server.xnaddress,
                    players: server.players,
                    isDedicated: server.isDedicated,
                    gameVersion: server.gameVersion,
                    eldewritoVersion: server.eldewritoVersion,
                    adultsOnly: server.adultsOnly,
                    firstSeenAt: server.firstSeenAt,
                    eldewritoVersionShort: server.eldewritoVersionShort,
                    reverseDns: server.reverseDns,
                });
            });

            serverArray.value = [];
            serverArray.forEach(serverData => {
                try {
                    const server = new ElDewritoServer(serverData);
                    servers.value.push(server);
                } catch (error) {
                    if (error instanceof ValidationError) {
                        console.warn(`Validation failed for ${serverData.ip}:`, error.errors);
                    } else {
                        console.error(`Unexpected error for server ${serverData.ip}:`, error);
                    }
                }
            });

            showBrowser.value = true;
        })
        .catch((error) => {
            browserStatus.value = 'Whoops, something bad happened.';
            console.error(error);
        });
}

function updateCounts(count) {
    playerCount.value = count.players;
    serverCount.value = count.servers;
    const rip = playerCount.value === 0 ? ' rip' : '';

    browserStatus.value = `${playerCount.value} players on ${serverCount.value} servers.${rip}`;
}

onMounted(async () => {
    fetchPlebBrowser();
});
</script>

<template>
    <Head title="PlebBrowser">
        <meta name="description" content="Find and join ElDewrito servers with the server browser. Play unique maps, game modes, and mods from the community."/>
    </Head>

    <section class="section">
        <div class="container">
            <h1 class="title is-2">PlebBrowser</h1>
            <p class="subtitle is-spaced">{{ browserStatus }}</p>

            <div class="table-container">
                <ServerBrowser v-if="showBrowser" :servers="servers"/>
            </div>

            <h2 class="title is-3">Stats</h2>
            <p class="subtitle">Temporarily unavailable.</p>
        </div>
    </section>
</template>

<style>
:root {
    --background: var(--bulma-body-background-color);
}

html.dark {
    --background: var(--bulma-body-background-color-dark);
}
</style>
