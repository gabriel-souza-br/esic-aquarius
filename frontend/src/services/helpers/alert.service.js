/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { Notify } from 'quasar'

export default class AlertService {

    constructor(http_resp) {
        this._http_resp = http_resp;
    }

    /**
     * Responsável por processar as mensagens
     **/
    processa() {
        const tipo = ["undefined", "positive", "info", "warning", "negative"];

        if (this._http_resp && this._http_resp.data.alert) {

            var alerta = this._http_resp.data.alert;
            setTimeout(() => {
                Notify.create({
                    progress: true,
                    type: tipo[alerta.tipo],
                    message: alerta.mensagem,
                    position: "top-right",
                })
            });

        }
    }

}