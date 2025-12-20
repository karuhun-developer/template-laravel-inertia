<script setup lang="ts">
import {
    create,
    destroy,
    edit,
} from '@/actions/App/Http/Controllers/Cms/Management/RoleController';
import Heading from '@/components/Heading.vue';
import ResourceTable from '@/components/ResourceTable.vue';
import { Button } from '@/components/ui/button';
import { useConfirm } from '@/composables/useConfirm';
import { useToast } from '@/composables/useToast';
import AppLayout from '@/layouts/AppLayout.vue';
import { PaginationItem, type BreadcrumbItem } from '@/types';
import { RoleDataItem } from '@/types/cms/management/role';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ModalLink } from '@inertiaui/modal-vue';
import dayjs from 'dayjs';
import 'dayjs/locale/id';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{
    data: PaginationItem<RoleDataItem>;
    orderBy?: string;
    order?: 'asc' | 'desc';
    search?: string;
    paginate?: number;
    resource: string;
}>();

const page = usePage();
const { confirm } = useConfirm();
const { toast } = useToast();

// @ts-ignore
const can = computed(() => page.props.auth.user.can);

const title = 'Role Management';
const description =
    'Manage roles and their permissions within the application.';

const columns = [
    { label: 'Name', key: 'name', sortable: true },
    { label: 'Guard', key: 'guard_name', sortable: true },
    { label: 'Created At', key: 'created_at', sortable: true },
    {
        label: 'Actions',
        key: 'actions',
        sortable: false,
        class: 'w-24 text-center',
    },
];

// Breadcrumbs
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Managements',
        href: '#',
    },
    {
        title: title,
        href: '#',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="title" />
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <Heading :title="title" :description="description" />
                <ModalLink
                    :href="create().url"
                    slideover
                    v-if="can['create' + resource]"
                >
                    <Button>
                        <Plus class="h-4 w-4" />
                        Create
                    </Button>
                </ModalLink>
            </div>
            <ResourceTable
                :data="data"
                :columns="columns"
                :order-by="orderBy"
                :order="order"
                :search="search"
                :paginate="paginate"
            >
                <template #created_at="{ row }">
                    {{ dayjs(row.created_at).format('DD MMMM YYYY') }}
                </template>
                <template #actions="{ row }">
                    <div class="flex items-center justify-center gap-2">
                        <ModalLink
                            :href="edit({ role: row.id }).url"
                            slideover
                            v-if="can['update' + resource]"
                        >
                            <Button variant="ghost" size="icon">
                                <Pencil class="h-4 w-4" />
                            </Button>
                        </ModalLink>
                        <Button
                            variant="ghost"
                            size="icon"
                            v-if="can['delete' + resource]"
                            @click="
                                confirm({
                                    title: 'Delete Role?',
                                    text: 'This action cannot be undone.',
                                    icon: 'warning',
                                    confirmButtonText: 'Yes, delete it!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        router.delete(
                                            destroy({ role: row.id }).url,
                                            {
                                                preserveScroll: true,
                                                preserveState: true,
                                                onSuccess: () => {
                                                    toast.fire({
                                                        icon: 'success',
                                                        title: 'Role deleted successfully.',
                                                    });
                                                },
                                            },
                                        );
                                    }
                                })
                            "
                        >
                            <Trash2 class="h-4 w-4 text-destructive" />
                        </Button>
                    </div>
                </template>
            </ResourceTable>
        </div>
    </AppLayout>
</template>
