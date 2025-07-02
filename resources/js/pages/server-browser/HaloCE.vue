<script setup lang="ts">
import ServerBrowser from '@/components/server-browser/plebbrowser/ServerBrowser.vue';
import { ValidationError } from '@/exceptions/ValidationError';
import { ElDewritoServer } from '@/models/ElDewritoServer';
import { Head } from '@inertiajs/vue3';
import 'bulma/css/bulma.min.css';
import 'highcharts/css/highcharts.css';
import { Chart } from 'highcharts-vue';
import { onMounted, ref } from 'vue';
import Browser from '@/components/server-browser/halo-ce/Browser.vue';

interface Props {
    plebBrowserApi: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Browser></Browser>
</template>

