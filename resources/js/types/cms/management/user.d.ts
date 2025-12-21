export interface UserDataItem {
    id: number;
    role_name?: string;
    name: string;
    email: string;
    phone?: string;
    email_verified_at?: string;
    created_at: string;
    updated_at: string;
    roles?: RoleDataItem[];
}
