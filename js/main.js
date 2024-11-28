function atualizarCidades() {
    const estado = document.getElementById('estado').value;
    const cidadeSelect = document.getElementById('cidade');
    cidadeSelect.innerHTML = '<option value="">Selecione a cidade</option>'; 

    let cidades = [];

  
    if (estado === 'SP') {
        cidades = ['São Paulo', 'Campinas', 'Santos', 'Ribeirão Preto', 'Sorocaba'];
    } else if (estado === 'RJ') {
        cidades = ['Rio de Janeiro', 'Niterói', 'Petrópolis', 'Cabo Frio', 'Volta Redonda'];
    } else if (estado === 'MG') {
        cidades = ['Belo Horizonte', 'Uberlândia', 'Juiz de Fora', 'Contagem', 'Betim'];
    } else if (estado === 'BA') {
        cidades = ['Salvador', 'Feira de Santana', 'Vitória da Conquista', 'Camaçari', 'Itabuna'];
    } else if (estado === 'PR') {
        cidades = ['Curitiba', 'Londrina', 'Maringá', 'Ponta Grossa', 'Cascavel'];
    } else if (estado === 'RS') {
        cidades = ['Porto Alegre', 'Caxias do Sul', 'Pelotas', 'Santa Maria', 'Passo Fundo'];
    } else if (estado === 'SC') {
        cidades = ['Florianópolis', 'Joinville', 'Blumenau', 'Chapecó', 'Criciúma'];
    } else if (estado === 'PE') {
        cidades = ['Recife', 'Olinda', 'Jaboatão dos Guararapes', 'Caruaru', 'Petrolina'];
    } else if (estado === 'CE') {
        cidades = ['Fortaleza', 'Caucaia', 'Juazeiro do Norte', 'Sobral', 'Crato'];
    } else if (estado === 'GO') {
        cidades = ['Goiânia', 'Aparecida de Goiânia', 'Anápolis', 'Rio Verde', 'Luziânia'];
    } else if (estado === 'ES') {
        cidades = ['Vitória', 'Vila Velha', 'Serra', 'Cariacica', 'Anchieta'];
    } else if (estado === 'MA') {
        cidades = ['São Luís', 'Imperatriz', 'Caxias', 'Timon', 'Açailândia'];
    } else if (estado === 'MT') {
        cidades = ['Cuiabá', 'Várzea Grande', 'Rondonópolis', 'Sinop', 'Tangará da Serra'];
    } else if (estado === 'MS') {
        cidades = ['Campo Grande', 'Dourados', 'Três Lagoas', 'Corumbá', 'Ponta Porã'];
    } else if (estado === 'AL') {
        cidades = ['Maceió', 'Arapiraca', 'Palmeira dos Índios', 'Rio Largo', 'Delmiro Gouveia'];
    } else if (estado === 'PB') {
        cidades = ['João Pessoa', 'Campina Grande', 'Santa Rita', 'Patos', 'Bayeux'];
    } else if (estado === 'SE') {
        cidades = ['Aracaju', 'Lagarto', 'Itabaiana', 'Nossa Senhora do Socorro', 'Estância'];
    } else if (estado === 'RN') {
        cidades = ['Natal', 'Mossoró', 'Parnamirim', 'São Gonçalo do Amarante', 'Macau'];
    } else if (estado === 'PI') {
        cidades = ['Teresina', 'Parnaíba', 'Picos', 'Floriano', 'Bom Jesus'];
    } else if (estado === 'AC') {
        cidades = ['Rio Branco', 'Sena Madureira', 'Cruzeiro do Sul', 'Tarauacá', 'Feijó'];
    } else if (estado === 'AP') {
        cidades = ['Macapá', 'Santana', 'Laranjal do Jari', 'Oiapoque', 'Amapá'];
    } else if (estado === 'RO') {
        cidades = ['Porto Velho', 'Ji-Paraná', 'Ariquemes', 'Cacoal', 'Vilhena'];
    } else if (estado === 'TO') {
        cidades = ['Palmas', 'Araguaína', 'Gurupi', 'Paraíso do Tocantins', 'Porto Nacional'];
    } else if (estado === 'RR') {
        cidades = ['Boa Vista', 'Rorainópolis', 'Caracaraí', 'Mucajaí', 'Cantá'];
    } else if (estado === 'MS') {
        cidades = ['Campo Grande', 'Dourados', 'Três Lagoas', 'Corumbá', 'Ponta Porã'];
    } else if (estado === 'DF') {
        cidades = ['Brasília', 'Taguatinga', 'Ceilândia', 'Águas Claras', 'Samambaia'];
    }

    cidades.forEach(cidade => {
        const option = document.createElement('option');
        option.value = cidade;
        option.textContent = cidade;
        cidadeSelect.appendChild(option);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const titles = document.querySelectorAll('[data-toggle]');
    
    titles.forEach(title => {
        title.addEventListener('click', () => {
            const parent = title.parentElement; 
            const content = parent.querySelector('.conteudo');

            if (content) {
                content.classList.toggle('ativo'); 
            }
        });
    });
});