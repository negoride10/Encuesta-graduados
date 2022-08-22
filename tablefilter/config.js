let tfConfig = {
    paging: {
        results_per_page: ['Resultados: ', [10, 25, 50, 100]]
    },
    base_path: 'tablefilter/',
    alternate_rows: true,
    btn_reset: true,
    rows_counter: true,
    loader: true,
    status_bar: true,
    mark_active_columns: {
        highlight_column: true
    },
    highlight_keywords: true,
    no_results_message: true,
    extensions: [{
        name: 'sort'
    }],

    /** Bootstrap integration */

    // allows Bootstrap table styling
    themes: [{
        name: 'transparent'
    }]
};

export {tfConfig};