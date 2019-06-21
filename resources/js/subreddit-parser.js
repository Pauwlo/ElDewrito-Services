'use strict';

$(function () {

    let loaded = false;
    let $feed = $('#subreddit-feed');

    function timeSince(date) {
        if (typeof date !== 'object') {
            date = new Date(date);
        }

        let seconds = Math.floor((new Date() - date) / 1000);
        let intervalType;
        let interval = Math.floor(seconds / 31536000);

        if (interval >= 1) {
            intervalType = 'year';
        } else {
            interval = Math.floor(seconds / 2592000);
            if (interval >= 1) {
                intervalType = 'month';
            } else {
                interval = Math.floor(seconds / 86400);
                if (interval >= 1) {
                    intervalType = 'day';
                } else {
                    interval = Math.floor(seconds / 3600);
                    if (interval >= 1) {
                        intervalType = 'hour';
                    } else {
                        interval = Math.floor(seconds / 60);
                        if (interval >= 1) {
                            intervalType = 'minute';
                        } else {
                            interval = seconds;
                            intervalType = 'second';
                        }
                    }
                }
            }
        }

        if (interval > 1 || interval === 0) {
            intervalType += 's';
        }

        return interval + ' ' + intervalType;
    };

    $feed.html('<p>Loading posts...</p>');

    feednami.load('https://www.reddit.com/r/HaloOnline.rss').then(feed => {
        $feed.text('');
        loaded = true;
        let i = 0;

        // Skip the first two posts (pinned)
        $.each(feed.entries.slice(2), function (k, v) {
            i++;

            let output = `<a href="${v.link}" target="_blank" class="listview__item mb-2">
                                <div class="listview__content">
                                    <div class="listview__heading text-truncate">${v.title}</div>
                                    <p>by ${v.author}, ${timeSince(v.date)} ago</p>
                                </div>
                            </a>`;

            $feed.append(output);
            return i != 7;
        });
    });

    setTimeout(function() {
        if (!loaded) {
            $feed.html('<p>Oops, something happened. Couldn\'t load posts.</p>');

            let title = 'Error';
            let message = 'Couldn\'t load Reddit posts. Try refreshing this page.';

            let toast = `
                <div class="toast toast--right" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="3000" data-animation="true">
                    <div class="toast-header">
                        <i class="zwicon-arrow-top-right text-orange"></i>
                        <strong>${title}</strong>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;

            $('.content__inner').prepend(toast);
            $('.toast').toast('show');
        }
    }, 5000);

});
