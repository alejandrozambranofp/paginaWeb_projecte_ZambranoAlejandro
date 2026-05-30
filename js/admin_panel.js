class AdminPanel {
    constructor() {
        this.tabKey = 'sweet_admin_tab';
        this.productRows = Array.from(document.querySelectorAll('#productos tbody tr'));
        this.logRows = Array.from(document.querySelectorAll('#logs tbody tr'));
    }

    init() {
        this.restoreActiveTab();
        this.bindTabStorage();
        this.createSummary();
        this.bindTableSearch();
        this.bindCurrencySelect();
    }

    restoreActiveTab() {
        const savedTab = localStorage.getItem(this.tabKey);

        if (!savedTab) {
            return;
        }

        const tabButton = document.querySelector(`[data-bs-target="${savedTab}"]`);

        if (tabButton && window.bootstrap) {
            new bootstrap.Tab(tabButton).show();
        }
    }

    bindTabStorage() {
        const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');

        tabs.forEach((tab) => {
            tab.addEventListener('shown.bs.tab', (event) => {
                localStorage.setItem(this.tabKey, event.target.getAttribute('data-bs-target'));
            });
        });
    }

    createSummary() {
        const container = document.querySelector('.tab-content');

        if (!container) {
            return;
        }

        const totalProductos = this.productRows.filter((row) => row.children.length > 1).length;
        const totalLogs = this.logRows.filter((row) => row.children.length > 1).length;

        const resumen = document.createElement('div');
        resumen.className = 'alert alert-light border d-flex flex-wrap gap-4 align-items-center mb-4';
        resumen.innerHTML = `
            <strong>Resumen admin</strong>
            <span>Productos: ${totalProductos}</span>
            <span>Logs recientes: ${totalLogs}</span>
        `;

        container.prepend(resumen);
    }

    bindTableSearch() {
        const productosTab = document.querySelector('#productos');

        if (!productosTab) {
            return;
        }

        const searchWrapper = document.createElement('div');
        searchWrapper.className = 'mb-3';
        searchWrapper.innerHTML = `
            <input type="search" class="form-control" id="buscadorProductosAdmin" placeholder="Buscar producto en la tabla">
        `;

        const productosCard = productosTab.querySelector('.card:last-child .card-body');

        if (productosCard) {
            productosCard.prepend(searchWrapper);
        }

        const input = document.getElementById('buscadorProductosAdmin');

        if (!input) {
            return;
        }

        input.addEventListener('input', () => {
            const text = input.value.toLowerCase();

            this.productRows
                .filter((row) => row.children.length > 1)
                .map((row) => {
                    const visible = row.textContent.toLowerCase().includes(text);
                    row.style.display = visible ? '' : 'none';
                    return visible;
                })
                .reduce((count, visible) => visible ? count + 1 : count, 0);
        });
    }
    bindCurrencySelect() {
        const select = document.getElementById('currencySelect');
        const moneyCells = Array.from(document.querySelectorAll('.admin-money'));

        if (!select || moneyCells.length === 0) {
            return;
        }

        const symbols = {
            EUR: '€',
            USD: '$',
            GBP: '£',
            JPY: '¥'
        };

        const updateMoney = () => {
            const option = select.options[select.selectedIndex];
            const currency = select.value;
            const rate = Number(option.dataset.rate || 1);

            moneyCells.forEach((cell) => {
                const eur = Number(cell.dataset.eur || 0);
                const converted = eur * rate;
                const decimals = currency === 'JPY' ? 0 : 2;

                cell.textContent = `${converted.toFixed(decimals)}${symbols[currency]}`;
            });

            localStorage.setItem('sweet_admin_currency', currency);
        };

        const savedCurrency = localStorage.getItem('sweet_admin_currency');

        if (savedCurrency) {
            select.value = savedCurrency;
        }

        select.addEventListener('change', updateMoney);
        updateMoney();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const panel = new AdminPanel();
    panel.init();
});