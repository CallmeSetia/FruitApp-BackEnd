export const menuItems = [
    {
        id: 1,
        label: "Menu",
        isTitle: true
    },
    {
        id: 2,
        label: "menuitems.dashboards.text",
        icon: "bx-home-circle",
        link: "/",
    },
    {
        id: 6,
        isLayout: true
    },
    // Users
    {
        id: 46,
        label: "Users",
        isTitle: true
    },
    {
        id: 47,
        label: "User Admin",
        icon: "bx-user-circle",
        link: "/users/admin",
    },
    {
        id: 48,
        label: "User Customer",
        icon: "bx-user",
        link: "/users/customer",
    },
    // Suppliers
    {
        id: 461,
        label: "Suppliers",
        isTitle: true
    },
    {
        id: 471,
        label: "Produk",
        icon: "bx-user-circle",
        link: "/",
    },
    {
        id: 481,
        label: "Supplier",
        icon: "bx-user",
        link: "/",
    },
    {
        id: 491,
        label: "Transaksi Supplier",
        icon: "bx-user",
        link: "/",
    },


    // Stock
    {
        id: 501,
        label: "Stock",
        isTitle: true
    },
    {
        id: 502,
        label: "Stock",
        icon: "bx-user-circle",
        link: "/",
    },
    {
        id: 503,
        label: "Report Stock",
        icon: "bx-user",
        subItems: [
            {
                id: 5031,
                label: "Report Harian",
                link: "#",
                parentId: 503
            },
            {
                id: 5032,
                label: "Report Mingguan",
                link: "#",
                parentId: 503
            },
            {
                id: 5033,
                label: "Report Bulanan",
                link: "#",
                parentId: 503
            },
            {
                id: 5034,
                label: "Report Tahunan",
                link: "#",
                parentId: 503
            },
        ],
    },
    // Transaksi Customer
    {
        id: 511,
        label: "Transaksi Customer",
        isTitle: true
    },
    {
        id: 512,
        label: "Transaksi Harian",
        icon: "bx-user-circle",
        link: "/",
    },
    {
        id: 513,
        label: "Report Customer",
        icon: "bx-user-circle",
        subItems: [
            {
                id: 5131,
                label: "Report Harian",
                link: "#",
                parentId: 513
            },
            {
                id: 5132,
                label: "Report Mingguan",
                link: "#",
                parentId: 513
            },
            {
                id: 5133,
                label: "Report Bulanan",
                link: "#",
                parentId: 513
            },
            {
                id: 5034,
                label: "Report Tahunan",
                link: "#",
                parentId: 503
            },
        ],
    },
    // Laba Rugi
    {
        id: 511,
        label: "Laba Rugi (Kas)",
        isTitle: true
    },
    {
        id: 512,
        label: "Kas Operasional",
        icon: "bx-user-circle",
        link: "/",
    },
    {
        id: 512,
        label: "Laba Rugi Harian",
        icon: "bx-user-circle",
        link: "/",
    },
    {
        id: 512,
        label: "Laba Rugi Supplier",
        icon: "bx-user-circle",
        link: "/",
    },



];
