const MyAccountMemo = {};
const data = DTUTCourseStatusVisualBuilderData;

function Ajax(text = "") {
    // Use empty string as a valid cache key
    const key = 'status';
    // If we already fetched this preview, return cached Promise
    if (MyAccountMemo[key]) {
        return Promise.resolve(MyAccountMemo[key]);
    }

    const formData = new FormData();
    formData.append('action', 'powdcotu_divi5_module_action');
    formData.append('nonce', data.nonce);
    formData.append('context', 'DTUTCourseStatus');

    // Create the fetch promise
    const fetchPromise = fetch(data.ajax_url, {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                return { html: `<p>${data.data?.message || 'Unknown error'}</p>` };
            }
            return data.data; // { html: "...html content..." }
        })
        .catch(err => {
            return { html: `<p>Fetch error: ${err}</p>` };
        });

    // Store result in memo
    MyAccountMemo[key] = fetchPromise;

    return fetchPromise;
}

export default Ajax;