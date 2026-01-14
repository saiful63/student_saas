import { usePage } from '@inertiajs/vue3';

export function can(permission){
    const page = usePage();
    const roles = page.props.auth.roles ?? [];
    if(roles.includes('systemsuperadmin')){
        return true;
    }
    const permissions = page.props.auth.permissions ?? [];
    return permissions.includes(permission);
}
