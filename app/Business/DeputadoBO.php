<?php

namespace App\Business;

use App\Repository\DeputadoRepository;
use App\To\DeputadoTO;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Validator;

/**
 * Class DeputadoBO.
 *
 * @package App\Business
 * @author Gabrielllns
 */
class DeputadoBO extends AbstractBO
{

    /**
     * @var DeputadoRepository
     */
    private $deputadoRepository;

    /**
     * Construtor da classe.
     *
     * @param DeputadoRepository $deputadoRepository
     */
    public function __construct(DeputadoRepository $deputadoRepository)
    {
        $this->deputadoRepository = $deputadoRepository;
    }

    /**
     * Recupera/atualiza a lista de 'Deputados' ativos do serviço na base de dados.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getListaDeputadosAtivos()
    {
        $deputadosAtivos = $this->getDadosAbertosService()->getDeputadosAtivos();
        return $this->persist($deputadosAtivos);
    }

    /**
     * Recupera a instância de 'Deputado' conforme o 'codigo' informado.
     *
     * @param integer $codigo
     * @return \App\Models\Deputado
     */
    public function getDeputadoPorCodigo($codigo)
    {
        return $this->deputadoRepository->getDeputadoPorCodigo($codigo);
    }

    /**
     * Recupera as instâncias de 'Deputado' cadastradas.
     *
     * @return \App\Models\Deputado[]
     */
    public function getDeputados()
    {
        return $this->deputadoRepository->getDeputados();
    }

    /**
     * Salva a instância de 'Deputado' na base de dados.
     *
     * @param array $deputadosAtivos
     * @return array
     * @throws \Exception
     */
    public function persist(array $deputadosAtivos)
    {
        $deputados = [];

        try {
            DB::beginTransaction();

            foreach ($deputadosAtivos as $deputadoAtivo) {
                $complementoDeputado = $this->getDadosAbertosService()->getComplementosDeputado($deputadoAtivo['id']);
                $complementoDeputadoAUX = $complementoDeputado['deputado'];

                $this->validarDeputado($complementoDeputadoAUX);
                $deputadoFormatado = $this->formatarArrayDeputado($complementoDeputadoAUX);

                $coDeputado = $deputadoFormatado['co_deputado'];
                $deputadoCadastrado = $this->getDeputadoPorCodigo($coDeputado);
                if (!empty($deputadoCadastrado)) {
                    $this->update($deputadoAtivo, $coDeputado);
                    $deputado = $this->getDeputadoPorCodigo($coDeputado);
                } else {
                    $deputado = $this->deputadoRepository->create($deputadoFormatado);
                }

                $deputadoTO = DeputadoTO::newInstance($deputado);

                if (!empty($complementoDeputadoAUX['redesSociais'])) {
                    $redesSociaisDeputados = $this->getRedeSocialDeputadoBO()->persist(
                        $deputado->id,
                        $complementoDeputadoAUX['redesSociais']
                    );

                    $deputadoTO->setRedesSociaisDeputados($redesSociaisDeputados);
                }

                array_push($deputados, $deputadoTO);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $deputados;
    }

    /**
     * Formata a instância de 'Deputado' para o modelo local.
     *
     * @param array $complementoDeputadoAUX
     * @return array
     */
    private function formatarArrayDeputado($complementoDeputadoAUX)
    {
        $deputado = [];
        $deputado['co_deputado'] = $complementoDeputadoAUX['id'];
        $deputado['ds_partido'] = $complementoDeputadoAUX['partido'];
        $deputado['ds_nome'] = $complementoDeputadoAUX['nomeServidor'];
        $deputado['ds_deputado'] = $complementoDeputadoAUX['vidaProfissionalPolitica'];

        return $deputado;
    }

    /**
     * Atualiza a instância de 'Deputado' recebida conforme o 'id' informado.
     *
     * @param array $newDeputado
     * @param integer $coDeputado
     * @return void
     * @throws \Exception
     */
    private function update(array $newDeputado, $coDeputado)
    {
        $deputado = $this->getDeputadoPorCodigo($coDeputado);

        try {
            $deputado->ds_nome = $deputado['ds_nome'];
            $deputado->ds_partido = $deputado['ds_partido'];
            $deputado->ds_deputado = $deputado['ds_deputado'];

            $deputado->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Valida o preenchimento dos campos obrigatórios de 'Deputado'.
     *
     * @param array $complementoDeputado
     * @throws ValidationException
     */
    private function validarDeputado(array $complementoDeputado)
    {
        $validations = [
            'id' => ['required'],
            'nome' => ['required'],
            'partido' => ['required'],
            'dataNascimento' => ['required'],
            'vidaProfissionalPolitica' => ['required']
        ];

        $validator = Validator::make($complementoDeputado, $validations);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}
