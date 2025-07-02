<script setup lang="ts">
import { computed, onMounted, ref, useTemplateRef, watch } from 'vue';
import { Vue3Marquee } from 'vue3-marquee';
import { Lock, Server, Triangle } from 'lucide-vue-next';
import { fetchServers } from '@/services/server-browser/fetchServers';
import { capitalize } from '@/lib/utils';

let servers = [];
const playerCount = ref(0);
const serverCount = ref(0);

const rowsPerPage = ref(1);
const pages = ref(1);
const currentPage = ref(1);
const visibleServers = ref([{}]);
const pageUpEnabled = computed(() => {
    return currentPage.value > 1;
});
const pageDownEnabled = computed(() => {
    return currentPage.value < pages.value;
});
const paginationButton = useTemplateRef('paginationButton');

const message = ref('We made it! Welcome to the new world of ElDewrito 0.7.');
const players = ref([]);
const rules = ref('');

const loading = ref(false);
const selectedServer = ref();

const audio = {
    click: new Audio('audio/browser/click.mp3'),
    hover: new Audio('audio/browser/hover.mp3'),
    secondary: new Audio('audio/browser/secondary.mp3'),
    scroll: new Audio('audio/browser/scroll.mp3'),
};

let loadingTimeout;
let resizeTimeout;

function shouldAddRows() {
    const row = document.querySelectorAll('tbody tr')[1];
    console.log(row)

    if (!row) {
        return true;
    }

    console.log(paginationButton, row)
    const a = paginationButton.value.offsetHeight;
    const b = row.offsetHeight;

    console.log(a,b)

    return a <= b;
}

function addRows() {
    if (!shouldAddRows()) return;

    rowsPerPage.value++;

    if (servers.length) {
        visibleServers.value.push(servers[rowsPerPage.value - 1]);
    } else {
        visibleServers.value.push({});
    }

    setTimeout(() => {
        addRows();
    });
}

function registerSounds(rowsOnly = false) {
    const rows = document.querySelectorAll('tbody tr:not(.disabled)');

    rows.forEach((row) => {
        row.removeEventListener('mouseover', playHoverSound);
        row.addEventListener('mouseover', playHoverSound);
    });

    if (rowsOnly) {
        return;
    }

    const th = document.querySelectorAll('th');
    th.forEach((h) => {
        h.removeEventListener('mousedown', playSound);
        h.addEventListener('mousedown', playSound, false);
        h.soundName = 'mousedown';
    });

    const buttons = document.querySelectorAll('nav button');
    buttons.forEach((button) => {
        button.removeEventListener('mousedown', playSound);
        button.addEventListener('mousedown', playSound);
    });

    const back = document.getElementById('back');
    back.removeEventListener('mousedown', playSound);
    back.addEventListener('mousedown', playSound, false);
    back.soundName = 'secondary';
}

onMounted(() => {
    initialize();

    window.addEventListener("resize", () => {
        clearTimeout(resizeTimeout);

        resizeTimeout = setTimeout(() => {
            visibleServers.value = [{}];
            rowsPerPage.value = 1;
            initialize();
        }, 100);
    });
});

function initialize() {
    addRows();
    registerSounds();
}

function getList() {
    loading.value = true;

    fetchServers()
        .then((data) => {
            addServers(data);
            loadingTimeout = setTimeout(() => {
                loading.value = false;
            }, 7000);
        })
        .catch((error) => {
            console.error(error);
        });
}

function addServers(data) {
    servers = [];

    const array = Object.entries(data.servers);

    array.forEach((entry) => {
        const ip = entry[0];
        const server = entry[1];
        server.ip = ip;

        servers.push(server);
    });

    playerCount.value = data.count.players;
    serverCount.value = data.count.servers;

    paginate();
}

function paginate(page = 1, slow = true) {
    const total = servers.length;

    currentPage.value = page;

    pages.value = total % rowsPerPage.value === 0 ? total / rowsPerPage.value : Math.ceil(total / rowsPerPage.value);

    const offset = (page - 1) * rowsPerPage.value;

    visibleServers.value = [];
    for (let i = 0; i < rowsPerPage.value; i++) {
        const index = offset + i;
        if (servers[index]) {
            setTimeout(() => {
                visibleServers.value.push(servers[index]);
            }, slow ? 16 * index : 0);
        } else {
            visibleServers.value.push({});
        }
    }

    setTimeout(() => {
        registerSounds(true);
    }, 50);
}

function getServerStatusString(server) {
    if (server.numPlayers > 0) {
        if (server.status === 'InLobby') {
            return 'In lobby';
        } else {
            return `Playing ${server.variant} on ${server.map}`;
        }
    } else {
        return '';
    }
}

function pageUp() {
    if (!pageUpEnabled.value) return;

    paginate(currentPage.value - 1, false);
}

function pageDown() {
    if (!pageDownEnabled.value) return;

    paginate(currentPage.value + 1, false);
}

function selectServer(server) {
    if (!server.ip) return;

    selectedServer.value = server.ip;
}

watch(selectedServer, (ip) => {
    const server = servers.find((s) => s.ip === ip);

    if (!server) return;

    showDetails(server);
});

function showDetails(server) {
    const type = capitalize(server.variantType);
    const status = getServerStatusString(server);

    const newRules = server.numPlayers === 0
        ? '--- (None) | Waiting for players --- '
        : `--- (${type} - "${server.variant}") | ${status} --- `;

    players.value = server.players;
    rules.value = newRules;
}

function playSound(event) {
    const name = event.target.soundName || 'click';
    audio[name]?.play();
}

function playHoverSound() {
    audio.hover.play();
}

function stop() {
    clearTimeout(loadingTimeout);
    loading.value = false;
}
</script>

<template>
    <div class="wrapper min-h-screen">
        <header>
            <h1>Internet lobby</h1>
            <img src="/images/browser/powered-by-eldewrito.png" alt="Powered by ElDewrito" />
        </header>

        <main>
            <div class="stats">
                <div class="players">Players: {{ playerCount }}</div>
                <div class="servers">
                    <p>Page {{ currentPage }}/{{ pages }}</p>
                    <p>Servers: {{ serverCount }}</p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th title="Password-protected"><Lock size="20" /></th>
                        <th title="Dedicated"><Server size="20" /></th>
                        <th>Server Name</th>
                        <th>Map</th>
                        <!--<th></th>--> <!-- TODO: Official server? -->
                        <th>Game</th>
                        <th>Players</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr :class="{ disabled: !pageUpEnabled }">
                        <td colspan="8" class="paginationRow">
                            <button class="paginationButton" @click="pageUp" :disabled="!pageUpEnabled" ref="paginationButton">
                                <Triangle width="50" height="18" preserveAspectRatio="none" :class="{ disabled: !pageUpEnabled }"/>
                            </button>
                        </td>
                    </tr>

                    <tr
                        v-for="server in visibleServers"
                        :key="server.ip"
                        @click="selectServer(server)"
                        :class="{
                            disabled: !server.name,
                            selected: selectedServer && server.ip === selectedServer,
                        }"
                    >
                        <template v-if="server.name">
                            <td><Lock v-if="server.passworded" size="20"/></td>
                            <td><Server v-if="server.isDedicated" size="20"/></td>
                            <td>{{ server.name }}</td>
                            <td>{{ server.map }}</td>
                            <td>{{ server.variant !== 'none' ? server.variant : '' }}</td>
                            <td>{{ server.numPlayers }} / {{ server.maxPlayers }}</td>
                            <td>{{ server.ip }}</td>
                        </template>
                        <template v-else>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </template>
                    </tr>

                    <tr :class="{ disabled: !pageDownEnabled }">
                        <td colspan="8" class="paginationRow">
                            <button class="paginationButton" @click="pageDown" :disabled="!pageDownEnabled">
                                <Triangle style="transform:rotate(180deg)" width="50" height="18" preserveAspectRatio="none" :class="{ disabled: !pageDownEnabled }"/>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="motd">
                <div v-if="!selectedServer">
                    Message
                    <Vue3Marquee :duration="7" animateOnOverflowOnly pauseOnHover>{{ message }}</Vue3Marquee>
                </div>
                <div v-else>
                    Players
                    <Vue3Marquee :duration="7" pauseOnHover>
                        <ul v-if="players && players?.length > 0" class="players">
                            <li v-for="player in players" :key="player.name">
                                {{ player.name }} {{ player.score }}
                            </li>
                        </ul>
                    </Vue3Marquee>
                </div>
                <div>
                    Rules
                    <Vue3Marquee :duration="7" pauseOnHover>{{ rules }}</Vue3Marquee>
                </div>
            </div>
        </main>
        <nav>
            <ul>
                <li>
                    <button @click="getList">Get List</button>
                </li>
                <li>
                    <button @click="loading ? stop() : getList()">{{ loading ? 'Stop' : 'Refresh' }}</button>
                </li>
                <li>
                    <button>Filters</button>
                </li>
                <li>
                    <button :disabled="!selectedServer">Join Game</button>
                </li>
                <li>
                    <button id="back">Back</button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<style>
@font-face {
    font-family: 'HandelGothic BT';
    src: url('/public/fonts/HandelGothic-BT.woff2') format('woff2'),
    url('/public/fonts/HandelGothic-BT.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

body {
    font-family: 'Trebuchet MS', Tahoma, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #000;
    background-image: url('/public/images/browser/background.jpg');
    background-size: cover;
    color: #ccc;
    font-weight: bold;
    overflow: hidden;
    line-height: normal;
    white-space: nowrap;
    user-select: none;
    cursor: url('/public/images/browser/cursor.png'), auto;
}

.wrapper {
    display: flex;
    flex-flow: column nowrap;
    height: 100vh;
}

header {
    padding-top: 0.5em;
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
}

header img {
    max-height: 5em;
}

h1 {
    font-size: 3em;
    margin-left: 1.5em;
    margin-bottom: -0.12em;
    padding: 0;
    text-transform: uppercase;
    font-family: 'HandelGothic BT', sans-serif;
    color: #2996ff;
}

main {
    border-top: 1px solid #2996ff;
    border-bottom: 1px solid #2996ff;
    background: rgb(7,28,54);
    background: linear-gradient(180deg, rgba(7,28,54,.9) 20%, rgba(7,28,54,0.2) 100%);
    padding: 0.5em 1.5em;
    text-shadow: 1px 1px 1px #000;

    flex: 1 1 auto;
    display: flex;
    flex-flow: column nowrap;
    margin-bottom: 2.75em;
}

.stats {
    display: flex;
    font-size: 1.3em;
    justify-content: space-between;
    text-transform: uppercase;
    height: 2em;
}

.stats .players {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1em;
    width: 12em;
    border: 2px solid #2996ff;
    border-bottom: none;
    border-radius: 1em 1em 0 0;
}

.stats .servers {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 24em;
    padding: 0 1em;
    border: 2px solid #2996ff;
    border-radius: 1em 1em 0 0;
    border-bottom: none;
}

table {
    width: 100%;
    border-left: 2px solid #2996ff;
    border-right: 2px solid #2996ff;
    border-bottom: 2px solid #2996ff;
    border-collapse: separate;
    border-spacing: 0 5px;
    border-radius: 0 0 1em 1em;
    flex: 1 1 auto;
    justify-items: flex-start;
}

thead {
    color: #2894fe;
}

thead th {
    border: 2px solid #2994ff;
    min-width: 1em;
    background: #00214a;
}

thead th:first-child {
    border-left: 3px solid #2996ff;
    min-width: 1em;
}

thead th:last-child {
    border-right: 3px solid #2996ff;
    min-width: 1em;
}

thead th:hover {
    color: #eff7ff;
    background: #004a84;
    border-color: #ccc;
}

th {
    height: 1.7em;
}

tbody tr:first-child,
tbody tr:last-child {
    height: 2em;
    text-align: center;
}

tbody tr:not(.disabled):hover {
    border: 3px solid #ccc; /* doesn't work without border-collapse */
    box-shadow: 0px 0px 3px #eff;
}

tr td {
    background: rgba(0, 0, 32, 0.33);
}

tbody tr td[colspan] {
    border-radius: 1em;
}

tbody tr td:not([colspan]):first-child {
    border-radius: 1em 0 0 1em;
}

tbody tr td:not([colspan]):last-child {
    border-radius: 0 1em 1em 0;
}

.motd {
    margin-top: 0.33em;
    display: flex;
    flex-direction: column;
    gap: 0.33em;
    background: #011b30;
    border: 3px solid #2996ff;
    border-radius: 1em;
    padding: 0.3em 1em;
}

.motd > div {
    display: flex;
    gap: 2em;
    background: #01122c;
    border-radius: 1em;
    padding: 0 0.1em;
    color: #2996ff;
}

.marquee {
    font-family: monospace;
    font-size: 1.3em;
    overflow: hidden;
    color: #e5e500;
}

.players {
    display: flex;
}

.players li {
    margin: 0 1em;
}

nav ul {
    display: flex;
    width: 100%;

    position: fixed;
    bottom: 0;
    padding: 0 0.33em 0.5em 0.33em;
}

nav ul li {
    width: 20%;
    padding: 0 .1em;
}

nav ul li button {
    width: 100%;
}

button {
    font-size: 1.3em;
    text-transform: uppercase;
    border: 3px solid #2288ff;
    border-radius: 1em;
    display: inline-block;
    background: #002244;
    padding: 0 2em;
    text-shadow: 2px 2px 1px #000;
}

button:disabled {
    opacity: .4;
}

button:hover:not(:disabled) {
    border-color: #eeffff;
    cursor: url('/public/images/browser/cursor.png'), auto;
}

.selected {
    border: 2px solid #adb612;
    box-shadow: 0px 0px 3px 3px #adb612 !important;
    background: rgba(1, 78, 55, .9) !important;
}

svg {
    margin: 0 auto;
    color: rgba(41, 150, 255, .9);
}

svg.disabled {
    opacity: .5;
}

.paginationRow {
    padding: 0;
    height: 1.5em;
    background: none;
}

.paginationButton {
    border: none;
    background: none;
    width: 95%;
    height: 100%;
    padding: 0;
    background: rgba(0, 15, 50, .5);
}

.paginationButton:hover {
    width: 95%;
    height: 100%;
    padding: 0;
    border: 2px solid #2094f7;
    background: #002244;
}
</style>
