import './bootstrap';

if (import.meta.env.VITE_MODE === 'production') {
        const noop = () => {}
        ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
            'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
            'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
            'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn',
        ].forEach((method) => {
            window.console[method] = noop
        })
}


