import Swal, { type SweetAlertOptions } from 'sweetalert2';

export function useConfirm() {
    const confirm = (options: SweetAlertOptions = {}) => {
        const defaultOptions: SweetAlertOptions = {
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true, // Often better UX to have primary action on right or reversed depending on OS, but standard web often puts primary right.
        };

        return Swal.fire({
            ...defaultOptions,
            ...options,
        } as SweetAlertOptions);
    };

    return {
        confirm,
    };
}
