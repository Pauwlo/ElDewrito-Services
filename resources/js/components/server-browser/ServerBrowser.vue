<script setup lang="ts">
import type { ElDewritoServer } from '@/models/ElDewritoServer';
import DataTable from '@/components/server-browser/DataTable.vue';
import { Button } from '@/components/ui/button';
import { ArrowUpDown, ExternalLink } from 'lucide-vue-next';
import { h, ref } from 'vue';

interface Props {
    servers: ElDewritoServer[];
}

defineProps<Props>();

const columns: ColumnDef<ElDewritoServer>[] = [
    {
        accessorKey: 'name',
        header: ({ column }) => {
            return h(Button, {
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Name', h(ArrowUpDown, { size: 14 })])
        },
        cell: ({ row }) => h('span', { class: 'font-bold!' }, row.getValue('name')),
    },
    {
        accessorKey: 'hostPlayer',
        header: ({ column }) => {
            return h(Button, {
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Host', h(ArrowUpDown, { size: 14 })])
        },
        cell: ({ row }) => row.getValue('hostPlayer'),
    },
    {
        id: 'status',
        header: ({ column }) => {
            return h(Button, {
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Status', h(ArrowUpDown, { size: 14 })])
        },
        accessorFn: (row) => row.statusFormatted(),
        cell: ({ row }) => row.original.statusFormatted(),
    },
    {
        accessorKey: 'numPlayers',
        header: ({ column }) => {
            return h(Button, {
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Players', h(ArrowUpDown, { size: 14 })])
        },
        cell: ({ row }) => {
            const server: ElDewritoServer = row.original;
            return `${server.numPlayers}/${server.maxPlayers}`;
        },
    },
    {
        accessorKey: 'eldewritoVersion',
        header: ({ column }) => {
            return h(Button, {
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['Version', h(ArrowUpDown, { size: 14 })])
        },
        cell: ({ row }) => row.original.versionWithoutTrailingZero(),
    },
    {
        accessorKey: 'ip',
        header: ({ column }) => {
            return h(Button, {
                class: 'text-left',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => ['IP', h(ArrowUpDown, { size: 14 })])
        },
        cell: ({ row }) => {
            const server = row.original;

            return h('span', { class: 'inline-flex items-center whitespace-nowrap' },
                [
                    h('a', {
                        href: `eldewrito://${server.ip}`,
                        target: '_blank',
                        title: `Click to join ${server.name}`,
                    }, server.ip),
                    h(
                        'a', {
                            href: `http://${server.ip}`,
                            target: '_blank',
                            title: `View JSON info`,
                            class: 'ml-1 inline-flex items-start',
                        }, h(ExternalLink, {
                            size: 16,
                            class: 'inline-block translate-y-[-0.25em]',
                        }),
                    ),
                ]
            );
        },
    },
]

//const showAdultsOnly = ref(false);

</script>

<template>
    <DataTable :columns="columns" :data="servers" />

    <!--<section class="mt-4">
        <input type="checkbox" v-model="showAdultsOnly" id="show-adults-only" />
        <label for="show-adults-only" class="ml-1">Show adults-only servers</label>
    </section>-->
</template>
