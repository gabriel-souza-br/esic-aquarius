/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { ref } from 'vue'

export function backendValidation() {

    const errors = ref([]);

    /*Popula o contexto com os erros passados do Backend*/
    function setBackendErrors(_errors) {
        errors.value = _errors
    }

    /*Função auxiliar que busca um campo específico (se existir o campo) */
    function findField(field) {
        return (errors.value[field]) ? errors.value[field] : [];
    }

    /*Recupera a primeira mensagem de erro de um campo específico (se existir) */
    function getBackendItemErrors(field) {
        const e = findField(field);
        return (e.length > 0) ? e[0] : '';
    }

    /*Verifica se existe erro em um campo específico (se existir o campo) */
    function hasBackendItemErrors(field) {
        return (findField(field).length !== 0) ? true : false
    }

    /*Verifica se existe erro em um campo específico (se existir o campo) */
    function clearBackendItemErrors(field) {
        errors.value[field] = [];
    }

    return {
        setBackendErrors,
        getBackendItemErrors,
        hasBackendItemErrors,
        clearBackendItemErrors
    }
}
