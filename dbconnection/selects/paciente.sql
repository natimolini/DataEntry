SELECT
    p.cd_pessoa_fisica,
    p.nm_pessoa_fisica,
    LISTAGG(c.nm_contato, ', ') WITHIN GROUP (ORDER BY c.nm_contato) AS nm_contatos,
    cep.ds_uf, 
    p.nr_cpf,
    p.dt_nascimento,
    TRUNC((MONTHS_BETWEEN(SYSDATE, p.dt_nascimento)) / 12) AS idade,
    MAX(cep.nm_localidade) AS nm_localidade
FROM
    pessoa_fisica p
LEFT JOIN
    compl_pessoa_fisica c ON p.cd_pessoa_fisica = c.cd_pessoa_fisica
LEFT JOIN
    cep_loc cep ON p.nr_cep_cidade_nasc = cep.cd_cep
WHERE
    p.nr_cpf IS NOT NULL
GROUP BY
    p.cd_pessoa_fisica,
    p.nm_pessoa_fisica,
    cep.ds_uf, 
    p.nr_cpf,
    p.dt_nascimento,
    p.nr_cep_cidade_nasc