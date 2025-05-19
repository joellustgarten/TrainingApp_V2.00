<?php



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Author: Joel Lustgarten, Organization: Technical training center, Area: MA-AA/TSS2-LA, Company: Robert Bosch Ltda., Country: Brazil, Content: Technical training material">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="rating" content="general" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="copyright" content="© Robert Bosch Ltda." />
    <meta name="keywords" content="Bosch, Technical training, Techical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <title>CTA | Training App</title>

</head>
<style>
    body {
        overflow: hidden;
        margin: 0;
    }

    .main_container {
        height: calc(100vh - 70px - 70px);
        /* Full height minus header (70px) and footer (70px) */
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        /* Allow vertical scrolling */
        padding-bottom: 20px;
    }

    #index_container {
        flex-grow: 1;
        /* Allow it to grow and fill the available space */
        display: flex;
        flex-direction: column;
        /* Ensure it stacks its children vertically */
        margin-bottom: 70px;
    }

    .footer {
        position: sticky;
        /* Keeps it at the bottom */
        bottom: 0;
        background-color: var(--bosch-white);
        z-index: 10;
    }

    @media (min-width: 992px) {
        #index_container {
            margin-left: auto;
            margin-top: auto;
        }
    }

    @media (max-height: 780px) {
        #index_container {
            margin-bottom: 150px;
        }
    }

    .i_container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .i_container {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .i_container {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .i_container {
            width: 1170px;
        }
    }

    .main_title {
        display: inline-block;
        width: 100%;
    }

    .main_title h5 {
        margin-bottom: 15px;
    }

    .main_title h5 span {
        font-size: 1rem;
        color: var(--bosch-gray-30);
        line-height: 1.3em;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .main_title p {
        margin-bottom: 30px;
        font-size: 1rem;
        color: var(--bosch-gray-30);
        line-height: 1.3em;
        font-weight: 400;
        text-align: justify;
    }

    .lower {
        display: none;
    }

    .course_name {
        font-size: 2rem;
    }
</style>

<body>
    <header class="o-header">
        <div class="o-header__top-container">
            <div class="e-container">
                <div class="o-header__top">
                    <a href="/" class="o-header__logo" aria-label="Bosch Logo">
                        <svg
                            width="108px"
                            height="24px"
                            viewBox="0 0 108 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                id="bosch-logo-text"
                                d="M78.19916,15.03735c0,3.46057-3.1618,5.1535-6.12445,5.1535c-3.41083,0-5.17847-1.29462-6.57263-2.96265 l2.51453-2.48962c1.07056,1.36926,2.46472,2.0415,4.0083,2.0415c1.29462,0,2.14105-0.62244,2.14105-1.56848 c0-0.99585-0.77179-1.31952-2.83813-1.74274l-0.54773-0.12451c-2.48962-0.52283-4.53113-1.91699-4.53113-4.75519 c0-3.112,2.53943-4.97925,5.87549-4.97925c2.8382,0,4.65564,1.21991,5.77594,2.48962l-2.46472,2.43988 c-0.82831-0.91748-2.00061-1.44946-3.23651-1.46893c-0.89624,0-1.91699,0.42328-1.91699,1.46893 c0,0.97095,1.07056,1.31946,2.41492,1.59332l0.54773,0.12451C75.51038,10.73029,78.24896,11.42737,78.19916,15.03735z  M64.80499,11.92529c0,4.65558-2.66394,8.29047-7.26971,8.29047c-4.58093,0-7.26971-3.63489-7.26971-8.29047 c0-4.63068,2.68878-8.29047,7.26971-8.29047C62.14105,3.63483,64.80499,7.29462,64.80499,11.92529z M60.92114,11.92529 c0-2.46472-1.1452-4.48132-3.38586-4.48132s-3.36102,1.9917-3.36102,4.48132s1.12036,4.50623,3.36102,4.50623 S60.92114,14.43982,60.92114,11.92529z M87.06226,16.43152c-1.74274,0-3.56018-1.44397-3.56018-4.60583 c0-2.81323,1.69293-4.38171,3.46057-4.38171c1.39423,0,2.21576,0.64728,2.8631,1.76764l3.18671-2.11621 c-1.59338-2.41492-3.48547-3.43567-6.09961-3.43567c-4.78009,0-7.36926,3.70953-7.36926,8.19086 c0,4.70544,2.86304,8.39008,7.31946,8.39008c3.13696,0,4.63074-1.09546,6.24902-3.43567l-3.21167-2.16602 C89.25311,15.68463,88.55603,16.43152,87.06226,16.43152z M48.97095,15.46057c0,2.66388-2.43982,4.40662-4.92944,4.40662H35.9502 V4.0332h7.44397c2.8382,0,4.9046,1.44397,4.9046,4.35681c0.01666,1.43036-0.85675,2.72058-2.19086,3.23651 C46.10791,11.65143,48.97095,12.29877,48.97095,15.46057z M39.80914,10.25726h2.83813 c0.02155,0.00134,0.04309,0.00226,0.06464,0.00269c0.81476,0.01575,1.48804-0.6319,1.50385-1.44666 c0.00342-0.0567,0.00342-0.11353,0-0.17017c-0.047-0.77802-0.71576-1.37061-1.49377-1.32361h-2.88794L39.80914,10.25726z  M44.76349,14.98755c0-0.92114-0.67218-1.54358-2.09131-1.54358h-2.81323v3.11206h2.88794 C43.91699,16.55603,44.76349,16.13275,44.76349,14.98755z M103.64313,4.03326v5.82568H98.8382V4.03326h-4.15771v15.83398h4.15771 v-6.24896h4.80493v6.24896h4.15771V4.03326H103.64313z" />
                            <path
                                id="bosch-logo-anker"
                                d="M12,0C5.37256,0,0,5.37256,0,12c0,6.62738,5.37256,12,12,12s12-5.37262,12-12C23.99646,5.37402,18.62598,0.00354,12,0z  M12,22.87964C5.99133,22.87964,1.12036,18.00867,1.12036,12S5.99133,1.1203,12,1.1203S22.87964,5.99133,22.87964,12 C22.87354,18.0061,18.0061,22.87354,12,22.87964z M19.50293,7.05475c-0.66852-1.01306-1.53552-1.88-2.54858-2.54852h-0.82159 v4.10785H7.89209V4.50623H7.04565c-4.13873,2.73114-5.27972,8.30029-2.54858,12.43896 c0.66852,1.01306,1.53552,1.88007,2.54858,2.54858h0.84644v-4.10791h8.24066v4.10791h0.82159 C21.09308,16.76257,22.23407,11.19348,19.50293,7.05475z M6.74689,17.87549c-3.24493-2.88354-3.5379-7.85168-0.65436-11.09668 c0.20508-0.23077,0.42358-0.44928,0.65436-0.65436V17.87549z M16.13275,14.24066H7.89209V9.73444h8.24066V14.24066z  M17.84827,17.25549c-0.18768,0.2088-0.38629,0.40747-0.59515,0.59509v-2.48962V8.61407V6.12445 C20.49121,9.03387,20.75763,14.0174,17.84827,17.25549z" />
                        </svg>
                    </a>
                    <div class="o-header__quicklinks">

                    </div>

                </div>
            </div>
        </div>
        <div class="e-container">
            <div class="o-header__meta">
                <ol class="m-breadcrumbs">
                    <li>
                        <div class="a-link -icon">
                            <a href="login.php" target="_self">
                                <i class="a-icon boschicon-bosch-ic-back-left-small" style="display:block;"></i>
                                <span>Back to menu</span>
                            </a>
                        </div>
                    </li>
                    <!--
                    <li>
                        <div class="a-link -icon">
                            <a href="/" target="_self">
                                <span>Internet of</span>
                                <span>
                                    Things
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                    -->
                </ol>
                <span class="o-header__subbrand">Training App - Privacidade</span>
            </div>
        </div>
    </header>

    <main style="padding-top: 54px;">
        <div class="main_container">
            <div id="index_container" class="i_container">
                <div class="main_title">
                    <h2 class="main_title_header"><span>Política de Privacidade</span></h2>
                    <h4 class="main_title_header"><span>Aviso sobre proteção de dados da Robert Bosch Ltda.</span></h2>
                        <p><span>A Robert Bosch Ltda. (a seguir “Bosch” e/ou “Nós”) se alegra com sua visita à nossas páginas e sites de internet, bem como aos nossos aplicativos móveis, e com seu interesse a respeito de nossa empresa e nossos produtos.</span></p>
                        <p><span>A aceitação desta Política de Privacidade se dará no ato do seu clique no botão de aceite. Ao clicar no botão localizado no final desta página, você nos dará seu consentimento livre, expresso e informado, concordando com o que é aqui disposto.</span></p>
                        <p><span>A utilização da página depende da aceitação a este documento. Assim, caso você não concorde com nossa Política de Privacidade, não deve utilizar nossas páginas de internet e aplicativos. Lembre-se também de que podemos atualizar as disposições contidas nesta Política a qualquer tempo, exceto em caso de vedação legal neste sentido, sendo recomendável e de sua responsabilidade que você a verifique com frequência.</span></p>
                        <h5><span><b>1.&nbsp;A Bosch respeita a sua privacidade</b></h5>
                        <p><span>1.1 A proteção de sua privacidade no processamento de seus dados pessoais, assim como a segurança de todos os dados da empresa, é para nós uma questão de grande importância, sendo levada em consideração em nossos processos corporativos. Nós processamos dados pessoais, coletados durante sua visita à nossa página de internet e aos nossos aplicativos móveis, tratando-os de maneira confidencial e somente conforme os requisitos legais.</span></p>
                        <p><span>1.2 Proteção de dados e segurança das informações são parte de nossa política corporativa.</span></p>
                        <h5><span><b>2.&nbsp;Coleta e processamento de dados pessoais</b></span></h5>
                        <p><span>2.1 Os dados pessoais são indicações individuais sobre as circunstâncias pessoais e factuais de uma pessoa natural identificada ou identificável, como por exemplo, nomes, endereços, telefones, endereços de correio eletrônico, fotos, números identificativos, dados locacionais ou outras informações sobre uma pessoa identificada ou identificável.</span></p>
                        <p><span>2.2 Nós coletamos, processamos e utilizamos dados pessoais (inclusive endereço de IP, com data e hora) somente quando há uma base jurídica para este propósito ou quando você tenha nos concedido uma declaração de consentimento livre, expresso e informado referente, por exemplo, a um cadastro, a uma pesquisa, a uma contribuição na Bosch Community, a um concurso ou a execução de um contrato.</span></p>
                        <p><span>2.3 Poderão ser coletados todos os dados inseridos ativamente por você na página, como, por exemplo, pelo preenchimento de eventuais formulários disponibilizados, bem como algumas informações geradas de forma automática, como IP com data e hora, características do navegador, páginas acessadas etc.</span></p>
                        <h5><span><b>3.&nbsp;Propósito da coleta de dados</b></span></h5>
                        <p><span>3.1 A Bosch ou um prestador de serviços designado pela Bosch utiliza seus dados pessoais para administração técnica da página de internet e aplicativos móveis, administração de clientes, sondagem sobre produtos e para suas consultas na Bosch, sempre restrito ao alcance necessário. A Bosch só utilizará as informações coletadas da forma descrita nesta política e por você autorizada.</span></p>
                        <p><span>3.2 Assim, ao manifestar seu aceite a esta Política, você dá seu consentimento livre, expresso e informado para que a Bosch colete informações por meio de sua página na internet e utilize as informações coletadas na forma e para os fins descritos nesta Política.</span></p>
                        <h5><span><b>4.&nbsp;Transferência de dados para terceiros</b></span></h5>
                        <p><span>4.1 A Bosch designou prestadores de serviço externos como serviços de vendas e marketing, gerenciamento de contratos, processamento de pagamento, programação, hospedagem de dados e serviços de hotline. A Bosch selecionou estes prestadores de serviço cuidadosamente e os monitora periodicamente, em particular o cuidadoso gerenciamento e a segurança dos dados salvos por eles. Todos os prestadores de serviço da Bosch são obrigados a manter a confidencialidade e a cumprir os requisitos legais de segurança, conforme descritos na Cláusula 16 desta política.</span></p>
                        <p><span>4.2 A Bosch só compartilhará seus dados com terceiros mediante seu consentimento expresso, livre e informado ou nas hipóteses exigidas pela legislação. Ao manifestar seu aceite por esta Política, você concorda com o compartilhamento de seus dados pessoais com os prestadores de serviço acima citados, para o exercício dos serviços mencionados.</span></p>
                        <h5><span><b>5.&nbsp;Utilização de cookies</b></span></h5>
                        <p><span>5.1 Geral<br>Cookies são pequenos arquivos de texto, que serão salvos no seu computador. Com base nesses arquivos, pode-se saber se seu terminal já se comunicou com nosso app. A leitura dos cookies nos permite ajustar nosso app à medida para você e facilitar sua utilização.</span></p>
                        <p><span>5.2 Bosch Cookies<br>A Bosch utiliza cookies e componentes ativos (por exemplo, JavaScript), a fim de poder seguir as preferências do visitante e aperfeiçoar o app apropriadamente.</span></p>
                        <p><span>5.3 Cookies de provedores terceiros<br>Este applicativo da Bosch não tem integrados conteúdos e serviços de outros provedores (por exemplo, YouTube, Facebook, X), e não utiliza cookies e componentes ativos.</span></p>
                        <h5><span><b>6.&nbsp;Utilização de otras ferramentas</b></span></h5>
                        <p><span>6.1 Neste app no utilizamos a tecnologia Retargeting, ni Conversion Tracking, asi como tampoco ferramentas de análise web, como WebTrends e Google Analytics. Para sua tranquilidade este app não utilizaça plug-ins sociais. </span></p>
                        <h5><span><b>7.&nbsp;Propaganda</b></span></h5>
                        <p><span>7.1 Consentimento e revogação<br />Quando você nos fornece dados pessoais, nós os utilizamos para fins publicitário, para lhe informar sobre nossos produtos e serviços. Ainda, os dados poderão ser utilizados em colaboração com um instituto de pesquisas, para o desenvolvimento de pesquisas estatísticas.<br />
                                Caso não deseje mais receber publicidade da Bosch, você pode, a qualquer momento, revogar seu consentimento para o futuro. Seus dados serão apagados ou, no caso de ainda seja necessário seu armazenamento, bloqueados.</span></p>
                        <h5><span><b>8.&nbsp;Bosch Communities</b></span></h5>
                        <p><span>8.1 Nós lhe oferecemos a possibilidade de se tornar membro nas nossas Bosch Communities (como Bob Community, 1-2-Do-Community, etc.). Lá você pode se registrar, criar um perfil de usuário e comunicar-se com outros membros. Os dados sobre você lá inseridos e gerados somente serão utilizados por nós com propósitos referentes a marketing, pesquisa de mercado e prestação de serviços, no âmbito de sua declaração de consentimento.</span></p>
                        <h5><span><b>9.&nbsp;Revogação do consentimento e exclusão dos dados</b></span></h5>
                        <p><span>9.1 Seu consentimento para a coleta, processamento e utilização de seus dados pessoais pode ser a qualquer momento revogado. Caso você deseje solicitar a exclusão dos dados coletados, poderá entrar em contato conosco por meio do e-mail: [Endereço do e-mail].</span></p>
                        <p><span>9.2 A exclusão dos seus dados pessoais de nossos servidores ocorrerá quando o seu consentimento para o armazenamento for revogado mediante pedido de exclusão ou quando atingida a finalidade para os quais foram coletados.</span></p>
                        <p><span>9.3 Dados que estejam sujeitos a obrigação legal de retenção não são afetados pelas hipóteses previstas acima. Nós armazenaremos seus dados, ao menos, pelo período exigido pela legislação. Quando o armazenamento não for mais requerido, esses dados poderão ser excluídos de nossos servidores.</span></p>
                        <h5><span><b>10.&nbsp;Contato</b></span></h5>
                        <p><span>Para informação, correção, sugestões e reclamações acerca do processamento de seus dados pessoais bem como acerca da revogação do seu consentimento, você pode nos contatar:</span></p>
                        <p><span> Centro de treinamento automotvo Bosch<br />Via Anhanguera, Km 98 Campinas<br />BRASIL</span></p>
                        <h5><span><b>11.&nbsp;Legislação e Foro Aplicáveis</b></span></h5>
                        <p><span>Esta Política será redigida, interpretada e executada de acordo com as leis da República Federativa do Brasil, mesmo no caso de conflitos dessas leis com leis de outros estados ou países, sendo competente o foro de domicílio do Usuário, no Brasil, para dirimir qualquer dúvida decorrente deste instrumento.</span></p>
                        <p><span>Data: 01.06.2025</span></p>
                </div>
            </div>
        </div>
    </main>
    <footer class="o-footer -minimal footer">
        <hr class="a-divider" />
        <div class="e-container">
            <div class="o-footer__bottom">
                <ul class="o-footer__links">
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="imprint.php" target="_self"><span>Imprint</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="avisos_legais.php" target="_self"><span>Legal information</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="privacidade.php" target="_self"><span>Data privacy</span></a>
                        </div>
                    </li>
                </ul>
                <hr class="a-divider" />
                <div class="o-footer__copyright">
                    <i
                        class="a-icon boschicon-bosch-ic-copyright-frame"
                        title="Lorem Ipsum"></i>
                    2021 Bosch.IO GmbH, all rights reserved
                </div>
            </div>
        </div>
    </footer>

</body>

<script>

</script>

</html>