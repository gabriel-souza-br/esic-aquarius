<?php
/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Services\Helper;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Models\Helper\Alert;

trait ValidacaoService
{
    use JsonRespostaService;
    /**
     * Validate the given request with the given rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return array
     *
     * @throws ValidationException
     */
    public static function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = app('validator')->make($request->all(), $rules, $messages, $customAttributes);
        if ($validator->fails()) {
            self::throwValidationException($validator);
        }
        return self::extractInputFromRules($request, $rules);
    }

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws ValidationException
     */
    protected static function throwValidationException($validator)
    {
        $json = self::responderErroValidacao(
            $validator->errors()->getMessages(),
            new Alert(Alert::TIPO_ERRO, 'Campo(s) preechido(s) com dado(s) inválido(s)', 'Erro de Validação!')
        );
        throw new ValidationException($validator, $json);
    }

    /**
     * Get the request input based on the given validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $rules
     * @return array
     */
    protected static function extractInputFromRules(Request $request, array $rules)
    {
        return $request->only(collect($rules)->keys()->map(function ($rule) {
            return Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
        })->unique()->toArray());
    }
}
