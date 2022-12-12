/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//Campo do tipo email:
const emailPattern = /^(?=[a-zA-Z0-9@._%+-]{6,254}$)[a-zA-Z0-9._%+-]{1,64}@(?:[a-zA-Z0-9-]{1,63}\.){1,8}[a-zA-Z]{2,63}$/;
export const email = val => emailPattern.test(val) || "E-mail inválido!";

//Campo Obrigatório:
export const required = val => (val && val.length > 0) || "Campo obrigatório!";

//O cpfcnpj deve ter 11 ou 14 caracters:
export const cpfcnpj = val => (val && (val.length === 11 || val.length === 14)) || "CPF/CNPJ com tamanho inválido!";

//Senha 1 e 2 devem ser iguais:
export const password_confirmation = (val, val2) => (val && val2 && val === val2) || "Senhas diferentes!";

//Campo com tamanho mínimo de 5 caracteres:
export const tamanho_minimo_5 = val => tamanho_minimo(val, 5);

//Campo com tamanho mínimo de 8 caracteres:
export const tamanho_minimo_8 = val => tamanho_minimo(val, 8);

//Cria vários formatos de tamanho mínimo do campo:
function tamanho_minimo(val, min) {
    return (
        (val && val.length >= min) ||
        "O campo deve ter " + min + " caracteres ou mais!"
    );
}