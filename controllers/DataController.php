<?php

class DataController {   

    public static function getDataGeneric( $param, $url_api, $type ) { 
        
        $url = $url_api.$param;                
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);	
        $response = curl_exec($client);
        $result = json_decode($response, true);
        $output = "";
        
        if (is_array($result) and count($result) > 0)
        {
            foreach($result as $row)
            {
                
                if ( $type === 'juridicos' ) {

                    $data_nasc = date_format(new DateTime($row['data_nasc']),'d/m/Y');
                    $cpf = $row['cpf_resp'];

                    if (strlen($cpf) == 11) {
                        $cpf = preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf);
                    } else {
                        $cpf = "CPF inválido";
                    }
                    $cnpj = $row['cnpj'];

                    if (strlen($cpf) == 14) {
                        $cnpj = preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $cnpj);
                    } else {
                        $cnpj = "CNPJ inválido";
                    }

                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$cnpj.'</td>                        
                        <td>'.$cpf.'</td>				
                        <td>'.$data_nasc.'</td>				
                        <td>'.$row['email'].'</td>				
                        <td><button name="edit" class="btn btn-primary edit" type=button data-id="'.$row['id'].'" title="Editar este cadastro">Editar</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button data-id="'.$row['id'].'" title="Deletar este cadastro">Deletar</button></td>  
                    </tr>
                    ';
                }
                else if ( $type === 'pessoasFisicas' ) {

                    $data_nasc = date_format(new DateTime($row['data_nasc']),'d/m/Y');
                    $cpf = $row['cpf'];

                    if (strlen($cpf) == 11) {
                        $cpf = preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf);
                    } else {
                        $cpf = "CPF inválido";
                    }

                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$cpf.'</td>				
                        <td>'.$data_nasc.'</td>				
                        <td>'.$row['email'].'</td>				
                        <td><button name="edit" class="btn btn-primary edit" type=button data-id="'.$row['id'].'" title="Editar este cadastro">Editar</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button data-id="'.$row['id'].'" title="Deletar este cadastro">Deletar</button></td>  
                    </tr>
                    ';
                }
            }
        }
        else
        {
            $output .= '
                <tr>
                    <td colspan=6>Nenhum resultado de dados.</td>
                </tr>
            ';
        }
        
        return $output;
    
    }    
}