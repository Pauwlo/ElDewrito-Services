const API_ENDPOINT = 'https://eldewrito.pauwlo.fr/api/';

export function fetchServers() {
    return new Promise((resolve, reject) => {
        fetch(API_ENDPOINT)
            .then((response) => response.json())
            .then(resolve)
            .catch(reject);
    });
}
