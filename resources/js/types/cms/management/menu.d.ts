import { RoleDataItem } from './role';

export interface MenuDataItem {
    id: number;
    role_id: number;
    role_name?: string;
    name: string;
    url: string;
    icon: string;
    order: number;
    active_pattern: string;
    status: boolean;
    created_at: string;
    updated_at: string;
    role?: RoleDataItem;
}
