<script setup lang="ts">
import ServerBrowser from '@/components/server-browser/plebbrowser/ServerBrowser.vue';
import { ValidationError } from '@/exceptions/ValidationError';
import { ElDewritoServer } from '@/models/ElDewritoServer';
import { Head } from '@inertiajs/vue3';
import 'bulma/css/bulma.min.css';
import 'highcharts/css/highcharts.css';
import { Chart } from 'highcharts-vue';
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

const statsStatus = ref('Loading...');
const chartOptions = ref({
    accessibility: {
        enabled: false,
    },
    chart: {
        styledMode: true,
        zoomType: 'x',
    },
    credits: {
        enabled: false,
    },
    title: {
        text: null,
    },
    xAxis: {
        type: 'datetime',
    },
    yAxis: {
        title: {
            text: null,
        },
    },
    legend: {
        enabled: false,
    },
    time: {
        useUTC: false,
    },
});

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
                    mods: server.mods,
                });
            });

            serverArray.value = [];
            serverArray.forEach((serverData) => {
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

function fetchStats() {
    fetch(`${props.plebBrowserApi}/stats`)
        .then((response) => response.json())
        .then((data) => {
            chartOptions.value.series = [
                {
                    name: 'Players',
                    data: data.players,
                    turboThreshold: 10000,
                    marker: {
                        enabled: false
                    },
                },
                {
                    name: 'Servers',
                    data: data.servers,
                    turboThreshold: 10000,
                    marker: {
                        enabled: false
                    },
                },
            ];

            statsStatus.value = '';
        })
        .catch((error) => {
            statsStatus.value = 'Whoops, something bad happened.';
            console.error(error);
        });
}

onMounted(async () => {
    fetchPlebBrowser();
    fetchStats();
});
</script>

<template>
    <Head title="PlebBrowser">
        <meta
            name="description"
            content="Find and join ElDewrito servers with the server browser. Play unique maps, game modes, and mods from the community."
        />
    </Head>

    <section class="section">
        <div class="container">
            <h1 class="title is-2">PlebBrowser</h1>
            <p class="subtitle is-spaced">{{ browserStatus }}</p>

            <div class="table-container">
                <ServerBrowser v-if="showBrowser" :servers="servers" />
            </div>

            <h2 class="title is-3">Stats</h2>
            <p class="subtitle">{{ statsStatus }}</p>

            <Chart v-if="chartOptions.series" :options="chartOptions"></Chart>

            <footer class="mt-20 opacity-20 hover:underline">
                <a :href="route('home')">owo what's this?</a>
            </footer>
        </div>
    </section>

</template>

<style>
:root {
    --background: var(--bulma-body-background-color);
}

@media (prefers-color-scheme: dark) {
    :root {
        --highcharts-background-color: #14161a;
    }
}
</style>
