import { usePage } from "@inertiajs/vue3";

export function usePermission() {
    const hasRole = (name) => usePage().props.auth.user.data.roles.includes(name);
    const hasPermission = (name) => usePage().props.auth.user.data.roles.includes(name);
    const hasRoles = (names) => usePage().props.auth.user.data.roles.some(name => names.includes(name));
    return { hasRole, hasPermission , hasRoles};
};
