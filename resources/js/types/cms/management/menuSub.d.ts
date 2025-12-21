import { MenuDataItem } from './menu';
import { RoleDataItem } from './role';

export interface MenuSubDataItem {
    id: number;
    role_id: number;
    menu_id: number;
    name: string;
    url: string;
    icon: string;
    order: number;
    active_pattern: string;
    status: boolean;
    created_at: string;
    updated_at: string;
    role?: RoleDataItem;
    menu?: MenuDataItem;
}
