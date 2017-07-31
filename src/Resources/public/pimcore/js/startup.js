pimcore.registerNS('pfaffenbauer.index.plugin');
pfaffenbauer.index.plugin = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return 'pfaffenbauer.index.plugin';
    },

    initialize: function () {
        pimcore.plugin.broker.registerPlugin(this);
    },

    uninstall: function () {
        //Nothing to do here, reload pimcore
    },

    pimcoreReady: function (params, broker) {
        Ext.get('pimcore_status').insertHtml('beforeEnd', '<div id="coreshop_status" class="loading" data-menu-tooltip="' + t('coreshop_loading') + '"></div>');

        this.initializeIndex();
    },

    initializeIndex: function () {
        var menu = [];
        var user = pimcore.globalmanager.get('user');

        var toolbar = pimcore.globalmanager.get('layout_toolbar');

        if (user.isAllowed('coreshop_permission_index')) {
            menu.push({
                text: t('coreshop_indexes'),
                iconCls: 'coreshop_icon_indexes',
                handler: this.openIndexes
            });
        }

        if (user.isAllowed('coreshop_permission_filter')) {
            menu.push({
                text: t('coreshop_filters'),
                iconCls: 'coreshop_icon_filters',
                handler: this.openProductFilters
            });
        }

        if (menu.length > 0) {
            this._menu = new Ext.menu.Menu({
                items: menu,
                shadow: false,
                cls: 'pimcore_navigation_flyout'
            });

            Ext.get('pimcore_navigation').down('ul').insertHtml('beforeEnd', '<li id="pimcore_menu_object_index" data-menu-tooltip="' + t('object_index') + '" class="pimcore_menu_item pimcore_menu_needs_children"></li>');
            Ext.get('pimcore_menu_object_index').on('mousedown', function (e, el) {
                toolbar.showSubMenu.call(this._menu, e, el);
            }.bind(this));
        }

        pimcore.helpers.initMenuTooltips();
    },

    openIndexes: function () {
        coreshop.global.resource.open('coreshop.index', 'index');
    },

    openProductFilters: function () {
        coreshop.global.resource.open('coreshop.index', 'filter');
    }
});

var plugin = new pfaffenbauer.index.plugin();
