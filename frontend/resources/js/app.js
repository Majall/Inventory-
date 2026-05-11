const modalSelector = (name) => document.querySelector(`[data-modal="${name}"]`);
const body = document.body;

const setModalState = (modal, isOpen) => {
    if (!modal) return;
    modal.classList.toggle('hidden', !isOpen);
    body.classList.toggle('overflow-hidden', isOpen);
};

const closeAllModals = () => {
    document.querySelectorAll('[data-modal]').forEach((modal) => setModalState(modal, false));
};

const bindModalControls = () => {
    document.querySelectorAll('[data-modal-open]').forEach((button) => {
        button.addEventListener('click', () => {
            const modalName = button.dataset.modalOpen;
            closeAllModals();
            setModalState(modalSelector(modalName), true);
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach((button) => {
        button.addEventListener('click', () => {
            closeAllModals();
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAllModals();
        }
    });
};

const bindMobileNav = () => {
    const mobileNav = document.querySelector('[data-mobile-nav]');
    const openButton = document.querySelector('[data-mobile-nav-toggle]');

    if (!mobileNav || !openButton) return;

    const toggleNav = (isOpen) => {
        mobileNav.classList.toggle('hidden', !isOpen);
        body.classList.toggle('overflow-hidden', isOpen);
    };

    openButton.addEventListener('click', () => toggleNav(true));
    mobileNav.querySelectorAll('[data-mobile-nav-close]').forEach((button) => {
        button.addEventListener('click', () => toggleNav(false));
    });
};

const bindThemeToggle = () => {
    const toggle = document.querySelector('[data-theme-toggle]');
    const label = document.querySelector('[data-theme-label]');

    const setTheme = (isDark) => {
        document.documentElement.classList.toggle('dark', isDark);
        if (label) {
            label.textContent = isDark ? 'Dark' : 'Light';
        }
        localStorage.setItem('inventory-theme', isDark ? 'dark' : 'light');
    };

    const storedTheme = localStorage.getItem('inventory-theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setTheme(storedTheme ? storedTheme === 'dark' : prefersDark);

    if (!toggle) return;
    toggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(!isDark);
    });
};

const toast = (() => {
    const toastEl = document.querySelector('[data-toast]');
    const toastTitle = document.querySelector('[data-toast-title]');
    const toastBody = document.querySelector('[data-toast-body]');
    const toastClose = document.querySelector('[data-toast-close]');
    let timeoutId;

    const show = ({ title, body: message }) => {
        if (!toastEl) return;
        if (toastTitle) toastTitle.textContent = title;
        if (toastBody) toastBody.textContent = message;
        toastEl.classList.remove('hidden');
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => toastEl.classList.add('hidden'), 4000);
    };

    if (toastClose) {
        toastClose.addEventListener('click', () => toastEl?.classList.add('hidden'));
    }

    return { show };
})();

const bindFormValidation = () => {
    const form = document.querySelector('[data-product-form]');
    const saveButton = document.querySelector('[data-save-product]');

    if (!form || !saveButton) return;

    const requiredFields = new Set([
        'name',
        'sku',
        'category_id',
        'status',
        'cost_price',
        'selling_price',
        'quantity',
        'reorder_level',
    ]);

    const minZeroFields = new Set(['cost_price', 'selling_price', 'quantity', 'reorder_level']);

    const showError = (field, show) => {
        const errorEl = form.querySelector(`[data-error="${field}"]`);
        if (errorEl) {
            errorEl.classList.toggle('hidden', !show);
        }
    };

    const validateField = (field, value) => {
        if (requiredFields.has(field) && !value.trim()) {
            return false;
        }
        if (minZeroFields.has(field) && value.trim() !== '' && Number(value) < 0) {
            return false;
        }
        if (field === 'expiry_date' && value) {
            const [year, month, day] = value.split('-').map(Number);
            const selectedDate = new Date(year, month - 1, day);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (Number.isNaN(selectedDate.getTime()) || selectedDate < today) {
                return false;
            }
        }
        return true;
    };

    form.querySelectorAll('[data-field]').forEach((input) => {
        input.addEventListener('input', () => {
            showError(input.dataset.field, false);
        });
    });

    saveButton.addEventListener('click', () => {
        let isValid = true;
        form.querySelectorAll('[data-field]').forEach((input) => {
            const fieldName = input.dataset.field;
            const value = input.value ?? '';
            const valid = validateField(fieldName, value);
            showError(fieldName, !valid);
            if (!valid) {
                isValid = false;
            }
        });

        if (!isValid) {
            toast.show({ title: 'Fix validation errors', body: 'Please review the highlighted fields.' });
            return;
        }

        form.reset();
        closeAllModals();
        toast.show({ title: 'Product saved', body: 'Changes are now live.' });
    });
};

const bindDeleteConfirmation = () => {
    const confirmButton = document.querySelector('[data-confirm-delete]');
    if (!confirmButton) return;

    confirmButton.addEventListener('click', () => {
        closeAllModals();
        toast.show({ title: 'Product deleted', body: 'The product was removed successfully.' });
    });
};

document.addEventListener('DOMContentLoaded', () => {
    bindModalControls();
    bindMobileNav();
    bindThemeToggle();
    bindFormValidation();
    bindDeleteConfirmation();
});
