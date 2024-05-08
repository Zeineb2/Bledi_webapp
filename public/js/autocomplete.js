// autocomplete.js

import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        // Initialize Autocomplete behavior
        new autoComplete({
            selector: this.element,
            minChars: 1, // Minimum number of characters before autocomplete kicks in
            source: async (term, response) => {
                // Fetch autocomplete suggestions from the server
                const url = this.data.get('autocomplete-source') + '?term=' + term;
                const results = await fetch(url);
                const data = await results.json();
                response(data);
            },
        });
    }
}
