/**
 * Adds a "reasoning" box if decline is selected; removes it otherwise.
 * @param {String} response Either "accept" or "reject." Anything else will be treated as "reject." 
 * @param {String} idSuffix A UUID for buttons on the page. 
 */
function changeResponse(response, idSuffix) {
    const accept_button = document.getElementById("accept-button-" + idSuffix);
    const decline_button = document.getElementById("decline-button-" + idSuffix);
    const ar_response = document.getElementById("ar-response-" + idSuffix);
    const ar_container = document.getElementById("ar-container-" + idSuffix);

    document.body.querySelector("input[type=submit]").disabled = false;

    if (response === 'accept') {
        accept_button.className = "accept-selected half-width";
        decline_button.className = "decline half-width";
        ar_response.value = "accept";

        const reasoning = document.getElementById("reasoning-" + idSuffix);
        if (reasoning != null) {
            reasoning.className = "reasoning shrink";
            setTimeout(function () {
                reasoning.remove();
            }, 500);
        }
    } else if (ar_response.value !== 'decline') {
        accept_button.className = "accept half-width";
        decline_button.className = "decline-selected half-width";
        ar_response.value = "decline";

        const reasoning = document.createElement("label");
        reasoning.id = "reasoning-" + idSuffix;
        reasoning.className = "reasoning";

        const text = document.createElement("p");
        text.innerHTML = "Reasoning is required.";
        reasoning.appendChild(text);

        const textField = document.createElement("textarea");
        textField.name = "reason";
        textField.rows = 10;
        textField.placeholder = "Reason...";
        textField.required = true;
        reasoning.appendChild(textField);

        insertAfter(ar_container, reasoning);
    }
}