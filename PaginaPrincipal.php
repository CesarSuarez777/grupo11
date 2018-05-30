<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Estilos.css">
      
  </head>
  <body>
          <?php
          include 'funciones.php';
          session_start();

          $incioSesion = inicioSesion();
          if (!$incioSesion){
            
            header("Location: index.php?inicio=$incioSesion");
            
            exit;
          }
          
        ?>
          <header style="position: fixed; position:absolute; z-index:1;">
            <nav>
                    <div class="row">
                        <div class="col-2">
                             <p>
                                <a href="PaginaPrincipal.php">
                                <img href="PaginaPrincipal.php" src="Logo.jpg" alt="Imagen no disponible"  class="rounded mx-auto d-block" height="120x120">
                                </a>
                            </p>
                        </div>
                        <div class="col-8">
                            <div class="row" position="fixed">
                                <div class="col-10">
                                    <br>
                                    <div class="input-group input-group-prepend mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Origen</font></span>
                                        </div>
                                      <input type="text" face="Univers-Light-Normal" class="form-control" placeholder="La Plata" aria-label="La Plata" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group input-group-prepend mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><font size="3" face="Univers-Light-Normal">Destino</font></span>
                                        </div>
                                    <input type="text" class="form-control" face="Univers-Light-Normal" placeholder="Berisso" aria-label="Berisso" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <button class="btn btn-outline-danger btn-lg btn-block btn-lg"><font size="5" face="Univers-Light-Normal">Ir</font></button><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <br>
                            <a href="MiCuenta.php" class="btn btn-outline-danger btn-block"><img src="Usuario.png" height="15x15"><font size="3" face="Univers-Light-Normal">     Mi cuenta</font></a><br>
                            <a href="MisViajes.php" class="btn btn-outline-danger btn-block"><img src="MisViajes.png" height="17x17"><font size="3" face="Univers-Light-Normal">     Mis viajes</font></a>
                        </div>     
                    </div>
            </nav>
        </header>
      <br><br><br><br><br><br>
          <div class="row">
              <div class="col-2 bg-white">
                  <br>
                  <div class="container-fluid" align="center"> 
                      <div class="btn-lg">
                        <button type="button" class="btn btn-lg btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <font size="3" face="Univers-Light-Normal">
                                Ordenar por:
                            </font>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#"> 
                            <font size="3" face="Univers-Light-Normal">
                                Calificación del conductor
                            </font></a>
                          <a class="dropdown-item" href="#">
                           <font size="3" face="Univers-Light-Normal">
                               Precio
                           </font>
                          </a>
                          <a class="dropdown-item" href="#">
                            <font size="3" face="Univers-Light-Normal">
                                Duración
                            </font>
                          </a>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-10 ">
                  <nav id="navbar-example2" class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link" href="#fat">@fat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#mdo">@mdo</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#one">one</a>
                          <a class="dropdown-item" href="#two">two</a>
                          <div role="separator" class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#three">three</a>
                        </div>
                      </li>
                    </ul>
                  </nav>
                  <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                    <h4 id="fat">@fat</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, quidem, pariatur, debitis soluta numquam est officiis a nisi sequi veritatis repellendus quos laborum molestias ex rerum totam beatae eum aut nemo facilis exercitationem consequatur laudantium nesciunt voluptas provident dolore velit. Hic cumque molestiae quidem eum soluta suscipit adipisci nulla labore.</p>
                    <h4 id="mdo">@mdo</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, veritatis tenetur modi consectetur quia officiis dicta totam doloribus magnam eos quos vero minus ratione et esse neque dolorem quisquam aspernatur alias assumenda ipsa sed iste natus perferendis rem laudantium pariatur deserunt unde minima explicabo. Asperiores, quas, praesentium aperiam architecto voluptatem neque cupiditate quis temporibus labore est voluptas numquam quod libero ipsum ab enim molestiae doloribus vero sit deleniti esse quibusdam nihil ea aut amet dolor illo sunt quisquam vel. Ut, suscipit ab tempora nisi cupiditate repudiandae incidunt. Inventore, nisi, repellat quidem soluta asperiores nihil voluptatum dicta quisquam veritatis illo vitae officiis saepe explicabo mollitia consectetur ipsum fugiat quos facilis commodi officia reprehenderit unde cum minus? Rem, at numquam quia magnam.</p>
                    <h4 id="one">one</h4>
                    <p>...</p>
                    <h4 id="two">two</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, a, pariatur, animi praesentium ea laborum facere voluptatibus consectetur magnam minus veritatis delectus voluptatem vitae at minima reprehenderit fuga! Quam, dignissimos hic ipsa id animi voluptates asperiores voluptatum deleniti doloribus expedita nostrum fugiat mollitia iure ducimus dolor quibusdam aut eius quas molestias amet maxime tempore corrupti vitae! Facilis, ab, atque, ullam sunt quibusdam unde totam quod suscipit optio aperiam labore magnam rerum eveniet assumenda vel similique dolores. Perferendis minus laudantium quia quas quis in modi aliquam beatae. Provident, delectus, illo, quis, dignissimos perspiciatis accusantium aspernatur deleniti laboriosam consectetur exercitationem expedita iusto soluta necessitatibus quo nisi eius praesentium maxime atque blanditiis aperiam eligendi et vitae officia sed officiis inventore quam est animi cumque quae. Eos, rem, unde perspiciatis itaque quam nulla minima vero odit sint consectetur numquam amet animi nam dignissimos sapiente sit voluptatibus alias inventore recusandae ipsa. Accusamus, commodi corporis tempore exercitationem rerum laudantium perferendis animi error consequuntur vitae. Deleniti quibusdam repudiandae officiis sed pariatur alias vitae odit! Asperiores, doloremque corporis provident a nam modi saepe veniam obcaecati reiciendis inventore itaque dignissimos eligendi minus neque tempore pariatur perferendis quos voluptates nesciunt accusamus. Vitae, totam, dolore, consequuntur sint perferendis ea beatae voluptates sequi expedita neque debitis reprehenderit tempora ut ipsum consequatur consectetur amet earum placeat eum voluptas explicabo reiciendis tenetur. Accusantium, officiis aliquid eos exercitationem veritatis. Deserunt, hic, dignissimos, distinctio ut aliquid adipisci doloremque animi error accusantium consequatur nihil at architecto recusandae repellat eum cumque iure dolor facere quasi quaerat nisi quas magni eveniet molestiae velit laudantium voluptate eos. Iste, voluptates, quos, debitis, pariatur quae labore repellat ducimus cum sunt inventore voluptatum error nobis dolorem dolores quisquam adipisci odit! Dignissimos, modi, vitae, minima numquam vero debitis repellendus aliquam unde facere minus beatae eaque fugit quia sequi eius alias ad ipsum officiis nihil magnam perferendis consectetur perspiciatis aliquid expedita quisquam! Minima, aut placeat labore dignissimos sint expedita exercitationem soluta ipsum suscipit qui officia accusantium illum asperiores. Sapiente, eius numquam commodi nesciunt. Ad, perspiciatis, recusandae, ducimus nihil animi in deserunt veniam quam laboriosam iste odit excepturi ipsam quibusdam itaque consectetur commodi cumque minima nesciunt molestias totam! Inventore, adipisci, possimus, natus, ullam eveniet voluptatibus laborum sint fugiat delectus asperiores minima dicta obcaecati dignissimos non doloribus quo soluta in explicabo officiis laudantium fuga molestiae beatae! Inventore, fugit neque accusantium provident amet necessitatibus fugiat eum dolore voluptas architecto recusandae in nostrum excepturi doloremque deleniti. Reiciendis, perspiciatis omnis rem veniam nesciunt soluta mollitia iusto corrupti deserunt magni placeat quisquam nihil voluptate hic facilis repellendus blanditiis fugiat quaerat sapiente voluptatem labore in velit. Magni, aut, harum natus officia minus nulla ut ducimus ipsum impedit quaerat sint dolorem ad id voluptate doloribus aperiam eligendi repellat expedita necessitatibus saepe quidem inventore dicta enim nemo quod velit deleniti esse mollitia reprehenderit et officiis accusantium consequuntur culpa! Officiis, ut, aut molestiae alias necessitatibus sed aspernatur obcaecati ad rem iure itaque excepturi velit quisquam nulla doloremque expedita dignissimos nesciunt voluptatum soluta in! Quasi, cum, voluptatem, necessitatibus, officia earum ea impedit in quisquam commodi at voluptas quaerat accusantium quidem repudiandae ad nulla soluta fugiat nemo quae accusamus aliquid nisi ratione molestiae eius assumenda. Facere, impedit, fugit delectus ullam similique voluptatem culpa cumque nobis ipsa quas aperiam fuga veniam amet placeat eligendi deleniti tempora voluptates architecto aliquid excepturi itaque nulla et assumenda quibusdam unde quasi voluptas dolore. Esse, dolore facere a nobis inventore ea iste fugit blanditiis quo! Quam, repellendus, modi placeat consequuntur eaque quod vitae officiis doloremque necessitatibus praesentium ipsa excepturi alias soluta pariatur sunt exercitationem cumque suscipit beatae quas quisquam maxime voluptate animi in debitis laboriosam totam deserunt omnis accusantium voluptates enim? Officiis, id nesciunt laboriosam iure ipsam quisquam assumenda error illo perspiciatis voluptatum at temporibus atque dolores nisi praesentium pariatur quibusdam reprehenderit laudantium omnis tempora quae consequuntur aspernatur enim molestias illum in eum sequi odio amet accusamus quos necessitatibus ex accusantium debitis ab fugit vel aut. Quos, nobis hic perferendis eveniet rerum! Est, ipsum excepturi repellat aliquid incidunt numquam dolorem adipisci quos amet dignissimos dolores quas minus consectetur ab labore obcaecati repudiandae error harum voluptatem ex modi fugit placeat recusandae unde perspiciatis! Officia, dolorum, unde saepe voluptatum suscipit tempore voluptates atque ducimus eaque minus repellat ratione corporis hic inventore sapiente quasi esse temporibus voluptas magni porro autem at exercitationem. Facilis, odit, deserunt, maxime excepturi distinctio praesentium reiciendis repellat nam corrupti beatae eum ipsa rerum quam. Architecto, sit, alias, incidunt corrupti optio iusto inventore rem ad repudiandae voluptatum dolore cupiditate perspiciatis sunt! Sit, quos, quas voluptate iure dolor deserunt pariatur optio porro sunt tempore tenetur debitis id asperiores. Voluptatum, sequi, unde sapiente at labore doloribus quam tempore accusantium nihil fugit non facere libero magnam praesentium quisquam nam tempora nostrum molestiae saepe assumenda possimus perspiciatis natus laboriosam eveniet quis necessitatibus repudiandae ipsa consectetur maiores enim. Sequi, quaerat omnis molestiae! Debitis, ducimus, a assumenda blanditiis aut corrupti voluptatum doloremque molestiae ab esse minus vel animi rerum dolore ullam quod maxime porro quo officia earum aliquam totam illo ipsam beatae ea tempora harum sapiente nihil magnam eligendi. Amet, officia, error, animi, ab laborum rem dolore nisi esse quia distinctio vel cumque eligendi expedita quasi id unde nulla porro ratione adipisci mollitia deserunt est at vero recusandae ullam in pariatur magnam enim nam alias eum voluptatibus modi iure ipsa dignissimos vitae fugiat quibusdam a velit minima tempora veritatis laboriosam consequatur voluptates reprehenderit natus! Doloribus, nam, tempora molestias reiciendis ipsa nobis obcaecati iusto qui assumenda laboriosam quia in ut autem saepe architecto tenetur voluptates nisi dignissimos natus velit porro nulla at dolore unde a! Eveniet, quia, velit aliquam saepe laborum aliquid impedit non ea ipsam dolore exercitationem libero nihil consequuntur facilis quos minima tempore voluptate nemo rem in! Molestias, tempora, et. Inventore, corporis, non, ea, itaque accusantium aliquam qui culpa rem nobis iure quae sapiente totam quidem rerum alias minus eius voluptatem magni sed quibusdam veritatis dolorum provident enim similique consequatur aperiam nesciunt! Vero, eveniet, repellendus, maxime, ex tempora consectetur beatae fuga blanditiis explicabo quasi iusto omnis dolores et molestiae aspernatur officia asperiores sed impedit laborum voluptatibus vel qui quo! In, veritatis, aliquid, dolores, itaque ratione et provident tempora fuga aut qui ea ad ducimus illo molestiae dolore temporibus quae deserunt magni distinctio vel quos expedita autem ipsam blanditiis dolor. Esse, quia, dolor asperiores inventore sit dolorem voluptas atque nesciunt eos doloribus vero illo officiis amet! Qui, quos, corrupti, fugiat, ea blanditiis at reprehenderit laborum itaque culpa saepe quibusdam repudiandae animi amet ad eos! Molestias blanditiis temporibus nostrum iste inventore doloribus enim laborum amet. Reprehenderit, sint quos debitis consequatur assumenda a est doloremque tenetur praesentium maxime accusamus sit laudantium nemo ex obcaecati veniam excepturi. Obcaecati, tenetur, dolorum, est asperiores assumenda omnis quod vitae inventore et pariatur eligendi ad velit suscipit impedit autem molestiae possimus! Est, rem, excepturi maiores nostrum inventore labore praesentium ab commodi cum amet vel itaque architecto in optio velit doloremque nulla quibusdam? Alias, quo, voluptatum, eligendi tenetur nam earum possimus error mollitia asperiores iusto qui pariatur suscipit at consequatur eaque. Eaque, atque, cumque quibusdam a aliquam voluptatum accusamus sunt dignissimos dolore fugit magnam sapiente nihil dolorem unde voluptas voluptates consequatur. Explicabo, sapiente, dolorem voluptatum molestias cupiditate accusamus nobis? Mollitia, voluptatem quidem magni velit reiciendis nostrum fugit explicabo. Maiores, doloribus numquam ex ut autem adipisci laboriosam ipsa impedit dolor vero. Tenetur, perspiciatis corrupti molestias doloribus neque quos aperiam corporis debitis minus mollitia? Sunt, possimus, id nihil explicabo impedit minima atque eligendi alias mollitia consequuntur quisquam facere recusandae rem! Quaerat, nemo, id, quam inventore ut totam sit ad repellat eius veritatis ratione nisi alias aliquam iusto facilis numquam magnam praesentium. Dolore, earum, alias molestiae maxime qui nostrum vitae repellendus ea cum quos impedit sapiente minus ratione incidunt fuga veritatis porro inventore provident! Eveniet, deleniti, error, vel, aliquam reprehenderit nesciunt itaque dolor repudiandae atque mollitia sapiente placeat expedita maiores fugiat earum distinctio repellendus sint quasi eum nobis. Qui, deleniti, at, aperiam sequi consequatur fugiat sed voluptatum accusantium officia excepturi magni rerum possimus est illum laborum beatae id aut perspiciatis. Tempora, iusto, magnam, necessitatibus, voluptatum odio vel distinctio architecto eum corrupti dolorum sed corporis placeat dolorem quis ab voluptatibus blanditiis! Laudantium, delectus, est ea suscipit debitis ex atque porro autem rem maiores tenetur reprehenderit ad enim? Quas, accusantium, odit, quibusdam deleniti similique ratione fugit aspernatur illo neque laudantium quos quo deserunt obcaecati provident quidem laboriosam ea suscipit reiciendis. Reiciendis, ea, dolorem tempora eligendi nihil molestiae necessitatibus officiis alias repellat sed est odio labore magni. Voluptatibus, perspiciatis, non eligendi facilis dicta est sed maxime debitis atque iste vero beatae maiores ducimus quaerat voluptates tempora aspernatur inventore tempore ratione pariatur qui consequatur laboriosam consectetur doloribus dolor dolorum nobis! Aliquid, facere, reprehenderit, nostrum eaque recusandae voluptates perspiciatis ipsa dolorum maxime possimus blanditiis inventore quis error incidunt at. Excepturi, facere, delectus dicta voluptatem similique ipsam sapiente placeat soluta. Ea, dolor, molestiae voluptate sunt quidem illo unde mollitia at maxime sapiente ipsam consequuntur ex amet distinctio excepturi cum consectetur doloremque voluptates ab reprehenderit fuga veritatis est quo aliquid quia enim quisquam? Iste, cupiditate saepe soluta debitis aspernatur quisquam esse. Maxime, reprehenderit quo illo cum odit ex recusandae quisquam corrupti dolores nobis! Cum, tempora, suscipit, pariatur, laudantium voluptatem voluptas eum error dolore iste nostrum ducimus delectus molestiae omnis libero fugit est excepturi maiores modi debitis autem deleniti et voluptatum vel nemo cumque neque soluta. Quos, doloremque suscipit explicabo sed. Animi, aliquam vitae quas dolorem quod omnis eligendi? Minus, aliquid architecto natus in deleniti. Accusantium hic fugiat consectetur quod voluptate quaerat sit doloribus. Aliquid, tenetur, doloribus, accusantium vel corporis voluptatibus quasi eaque repellendus explicabo esse consectetur rerum provident minima mollitia illo hic possimus! Nihil, architecto, in, dolorem explicabo quis similique ut iure nemo placeat accusantium voluptatem maiores quas quaerat mollitia eos adipisci sint odit amet rem id animi aperiam voluptas maxime. Dolor, blanditiis, fugiat repellendus odit debitis quam nesciunt ut amet aut aliquam laborum autem neque explicabo nisi culpa adipisci doloremque magnam maxime maiores reiciendis vel dolore laudantium inventore nulla laboriosam asperiores nam nemo dolores expedita in. Error, minus, sed ipsa incidunt rerum provident sunt vitae mollitia accusantium nam alias necessitatibus accusamus adipisci minima corporis distinctio eum nemo praesentium quaerat nobis labore animi at in sint culpa explicabo aperiam perspiciatis reiciendis asperiores quod voluptate quas aspernatur architecto delectus illum voluptas ullam! Nesciunt, natus explicabo voluptate voluptas dolorum ipsa perspiciatis totam eos at consequuntur nostrum possimus eaque provident ad dicta dolorem inventore soluta quas tenetur molestias quam maiores vero tempore accusantium atque sed aliquid veritatis voluptates autem itaque doloremque repellendus sapiente ea! Nesciunt, sequi hic a quaerat quibusdam ipsa quia perferendis molestias cum distinctio. Eaque, porro, blanditiis, accusamus totam officia nostrum voluptatibus modi accusantium ipsa sed et unde vel doloribus ab minima at aliquam cupiditate fugit reiciendis ratione perferendis voluptatem sunt maxime reprehenderit molestiae nulla illum error voluptas consectetur dicta. Unde, qui, cumque veniam libero beatae aliquid fuga facilis ducimus voluptatum veritatis repellendus totam accusamus ratione quos ipsum distinctio incidunt at. Id, aliquam voluptatem dolorem ex dolores veniam voluptates voluptas recusandae amet repudiandae? Numquam, ea dicta est culpa maiores cupiditate quidem provident enim dolorem itaque. Sit, reiciendis, minima, ipsam in velit laudantium reprehenderit explicabo corporis aut enim iusto molestias pariatur nesciunt? Consequatur, amet eos laborum numquam ipsam dignissimos alias earum provident illum voluptas sit nostrum autem tempore quibusdam quo necessitatibus harum voluptatem explicabo consectetur velit fugit quod distinctio. Omnis, dicta ratione error similique et incidunt labore neque. Nisi, nulla, quis, libero eligendi corporis dolores adipisci nobis velit provident magnam aspernatur eaque laudantium beatae dolorem aut veniam tempora reiciendis molestiae ut voluptas! Temporibus, excepturi, enim eum placeat ducimus sed laudantium repellat assumenda facilis nemo quaerat necessitatibus quos quasi illum velit similique incidunt? Voluptas, optio, saepe voluptates facilis ullam eligendi itaque deserunt provident temporibus quibusdam fugit sunt dicta rem similique cupiditate magnam sapiente architecto? Fugiat, eaque, praesentium, molestias est commodi rem labore quod nobis facere nihil corporis animi quo explicabo at doloribus eos odit libero nostrum eveniet necessitatibus debitis rerum iure veniam dolore maxime sapiente illo possimus asperiores dolor voluptatum ipsa iusto quos voluptate saepe iste totam sunt voluptas nam laborum pariatur architecto tempore in omnis et repellendus ea. Enim, quia, commodi architecto porro aliquam officia laudantium deleniti fugiat ratione hic possimus adipisci asperiores accusantium consequatur aspernatur ea harum. Repellendus quibusdam vel dignissimos. Vero, incidunt adipisci quasi ea sed assumenda libero inventore quaerat doloribus aliquid quibusdam totam obcaecati ipsa expedita eaque consectetur sapiente voluptates dignissimos possimus accusantium. At, animi, perspiciatis, quod perferendis ratione accusantium error non asperiores laudantium aut excepturi consequatur debitis hic ab quis nam eos impedit eligendi consequuntur nulla aperiam quos iste architecto nobis illum distinctio autem odio modi adipisci reprehenderit quia deleniti nostrum dolore molestias natus ad assumenda. Autem, illo, sequi dolore molestiae maiores eos ipsa minima tenetur non temporibus voluptatem eaque hic praesentium perspiciatis possimus vel illum qui sint officia repellendus distinctio incidunt est suscipit dolor rerum nostrum harum impedit reiciendis quo beatae vero a quidem vitae nesciunt quae id ut odio nihil assumenda iure. Ratione, aliquam, officiis, iusto facilis dolorum asperiores sint aperiam soluta nisi veritatis iure nihil quos maiores facere odio excepturi quisquam quo totam accusantium quibusdam! Similique, nobis, voluptatibus, facilis aliquam voluptate amet ipsa ea velit ex mollitia tempora fuga quam. Molestiae, tenetur explicabo quae nemo impedit perspiciatis velit eius nisi ullam rerum aut nesciunt neque quaerat magni natus incidunt facere eligendi. Exercitationem, temporibus quas perspiciatis eos deserunt provident officiis blanditiis repudiandae nulla ipsa eum dolor dolore esse hic atque. Sunt, mollitia odio ipsum cupiditate! Magnam, ea, praesentium excepturi fugiat laborum similique ducimus eligendi obcaecati voluptate aliquid. A, quae, consequuntur, similique, veritatis maiores ipsum laboriosam corporis ipsam tempora cum odio at possimus. Voluptas, ducimus voluptatibus ea odit est ipsum corporis tempore perspiciatis. Incidunt, sequi, aliquid, praesentium placeat labore aspernatur cum excepturi illum consequatur explicabo asperiores fuga veritatis facilis quam neque facere reprehenderit vitae sit. Nihil, quas, alias sed maxime libero dolor voluptate ipsum vitae cupiditate ex laudantium totam iure quaerat deserunt consectetur. Modi, eius, quas, facere, debitis esse voluptatum temporibus odit nobis illum dolores corrupti ipsam tenetur rerum iusto veniam? Eos, repellendus, rerum, deserunt soluta consectetur sunt atque fuga inventore similique nesciunt dicta cupiditate omnis ratione voluptas molestias alias natus quam voluptatibus eaque tempore. Similique, laboriosam, blanditiis, cum, obcaecati laborum labore soluta voluptates at mollitia repellat perspiciatis eius ut deserunt quasi quisquam tenetur totam possimus ratione in sit. Et, pariatur, eveniet illo minus soluta est at voluptatibus hic error dolorum accusamus ipsa ratione voluptate blanditiis qui dicta modi molestias veniam architecto quae totam quibusdam nam harum corrupti doloribus provident sunt magni sequi cumque? Aspernatur, sequi, quas eos doloremque doloribus quasi recusandae asperiores eligendi ullam possimus odio numquam iste sed culpa aliquam dolor amet laudantium vero illum magni saepe praesentium dolore explicabo ab autem corporis perferendis sapiente nulla voluptatum debitis quis natus harum quo quia consequuntur mollitia eaque minima quisquam ipsam nemo aperiam labore? Iste, repellendus minima dignissimos minus quisquam quibusdam tenetur voluptate a voluptatem debitis eligendi ratione maiores quae repudiandae at in provident odit amet harum esse aliquid vel excepturi laboriosam maxime voluptates. Porro, tenetur minus asperiores incidunt ullam modi libero mollitia cumque alias nesciunt. Cum, labore, architecto, accusantium, blanditiis illum omnis culpa temporibus nam molestias numquam neque corporis reprehenderit in distinctio atque maiores perferendis eveniet quos amet at illo officia quam rerum quia beatae cumque iusto veritatis eius quaerat maxime explicabo alias earum ratione? Dignissimos, dolorem, eius, quos nam atque et aliquam accusantium nesciunt explicabo natus velit assumenda debitis itaque facere totam harum dolore! Commodi, voluptatibus, maxime, amet, cupiditate sequi distinctio a architecto provident cum rerum sit culpa quaerat error ea tempore officiis est ratione ipsam ipsum dolorum accusantium nobis magni perferendis optio fugit alias odio earum officia doloremque maiores delectus nostrum dolores quisquam iste quo voluptas labore aperiam inventore recusandae sed assumenda nam. Tenetur, quae, facilis, omnis ut perferendis deleniti eligendi sint beatae accusantium vel voluptate corporis fuga ipsam quidem illo corrupti perspiciatis mollitia vero doloribus ea. Voluptates, ipsam, deserunt corporis dolor at ducimus omnis fuga eum aliquam quis laboriosam doloremque veniam nobis dignissimos obcaecati. Quod, hic, distinctio, possimus qui rem laudantium odit quibusdam est nobis non sequi corporis! Pariatur, molestiae ipsa nostrum iste impedit rerum inventore? Provident, est cupiditate quae suscipit cum hic quia. Molestias, dolorum, cum, consequatur sint sed dicta obcaecati adipisci explicabo sit optio ad dolorem aliquam nihil voluptates ipsa illum facilis harum omnis quam distinctio. Fugit, consequuntur perspiciatis quod commodi eum consequatur delectus et deserunt eligendi aut temporibus quos consectetur! Laboriosam laudantium nihil eos modi ad. Corporis, animi, obcaecati iure quidem at maiores quibusdam esse qui! Quo, nam, explicabo veritatis nobis id dicta vitae recusandae totam iste accusamus saepe praesentium numquam facere asperiores architecto. Aliquam, sed, suscipit, earum, corrupti neque ipsa quibusdam explicabo ut tempora repudiandae rerum eligendi nulla voluptatum quidem sint voluptatibus porro laboriosam necessitatibus reprehenderit voluptate. Similique quam perferendis harum nostrum tempore veniam sunt voluptates officiis laborum. Vitae, perferendis, dignissimos, iure modi saepe adipisci odio reiciendis itaque iusto necessitatibus tempore rem cumque corporis asperiores animi dicta similique hic amet possimus sint. Pariatur, commodi, dolor dolorem dolore inventore voluptatibus sapiente similique esse consectetur eaque dolores nostrum. Quasi, expedita, maiores, explicabo optio iure unde nihil obcaecati quisquam laborum id consequuntur alias quibusdam esse blanditiis iusto architecto quidem impedit animi sint exercitationem possimus atque corrupti neque molestias similique deserunt fuga nobis modi dolorem est at repellendus repellat soluta delectus quae provident aperiam! Itaque, cumque, ea, vel, obcaecati nostrum iusto blanditiis a eius nesciunt perferendis illum eaque ipsa voluptatibus odio voluptatem magni sit expedita placeat esse dicta alias perspiciatis praesentium accusantium deleniti quam corporis architecto aut quo quibusdam voluptas. Enim, voluptatum saepe voluptatibus natus perferendis obcaecati repellendus eum iste odio! Distinctio, hic, beatae libero animi suscipit dolor nobis. Cumque, nesciunt doloremque possimus illo illum rerum a ducimus dicta odit iusto explicabo recusandae minima saepe ut dolorum quae perspiciatis rem doloribus nam cupiditate aliquid nemo ratione fugit quia excepturi voluptatem deserunt porro tenetur ad beatae nobis repellendus soluta accusamus eligendi maxime aspernatur mollitia totam quod accusantium facere quidem optio assumenda neque amet distinctio libero. Eos, qui, amet molestias perferendis aut doloribus molestiae itaque maiores repellat ex dicta iure voluptatibus laboriosam sint accusamus porro fuga. Voluptatibus cum facere itaque fuga rem!</p>
                    <h4 id="three">three</h4>
                    <p>...</p>
                  </div>       
              </div>
          </div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <?php
    
    ?>
  </body>
  
</html>
