<template>
    <div class="index">
        <div class="carousel slide" id="mycarousel" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <picture>
                        <source media="(min-width:860px)" srcset="../image//big轮播.jpg">
                        <img src="../image/轮播1.jpg_wh860.jpg" alt="">
                    </picture>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width:860px)" srcset="../image/big轮播2.png">
                        <img src="../image/轮播2.jpg-1.jpg" alt="">
                    </picture>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(min-width:860px)" srcset="../image/big轮播3.png">
                        <img src="../image/轮播3.jpg-1.png" alt="">
                    </picture>
                </div>
            </div>

            <ol class="carousel-indicators">
                <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mycarousel" data-slide-to="1"></li>
                <li data-target="#mycarousel" data-slide-to="2"></li>
            </ol>
            <div class="inner">
                <a href="#mycarousel" class="carousel-control-prev" data-slide="prev" role="button">
                    <span class="carousel-control-prev-icon" style="filter: invert(100%);"></span>
                </a>
                <a href="#mycarousel" class="carousel-control-next" data-slide="next" role="button">
                    <span class="carousel-control-next-icon" style="filter: invert(100%);"></span>
                </a>

            </div>
        </div>
        <div class="container-fluid products">
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <div class="card">
                    <img src="../image/card1.png" alt="">
                    <div class="text px-4 pt-4">
                        <h3 class="h3">绿意融城，筑梦未来</h3>
                        <div class="words">
                            让绿色覆盖每个城市角落，共建宜居家园，创造可持续美好生活。
                        </div>
                    </div>
                    <div class="shop pt-3 pb-4 px-4">
                        <RouterLink :to="{
                            path: '/news',
                            query: {
                                title: '绿意融城，筑梦未来',
                                content: new1,
                                date: '2024-12-01'
                            }
                        }"><button type="button">立刻了解</button></RouterLink>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <div class="card">
                    <img src="../image/card2.png" alt="">
                    <div class="text px-4 pt-4">
                        <h3 class="h3">一棵树，千分氧</h3>
                        <div class="words">
                            种下一棵树，为地球添绿荫，让自然与未来充满生机和希望。
                        </div>
                    </div>
                    <div class="shop pt-3 pb-4 px-4">
                        <RouterLink :to="{
                            path: '/news',
                            query: {
                                title: '一棵树，千分氧',
                                content: new2,
                                date: '2024-12-01'
                            }
                        }"><button type="button">立刻了解</button></RouterLink>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6  mb-5 mb-lg-0">
                <div class="card">
                    <img src="../image/card3.png" alt="">
                    <div class="text px-4 pt-4">
                        <h3 class="h3">电动未来，绿色前行</h3>
                        <div class="words">
                            新能源车驱动未来，减少碳排放，为地球守护更纯净的蓝天。
                        </div>
                    </div>
                    <div class="shop pt-3 pb-4 px-4">
                        <RouterLink :to="{
                            path: '/news',
                            query: {
                                title: '电动未来，绿色前行',
                                content: new3,
                                date: '2024-12-01'
                            }
                        }"><button type="button">立刻了解</button></RouterLink>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <div class="card">
                    <img src="../image//card4.png" alt="">
                    <div class="text px-4 pt-4">
                        <h3 class="h3">共生共赢，美丽地球</h3>
                        <div class="words">
                            珍爱地球，共同守护自然，让人类与地球实现和谐共处之美。
                        </div>
                    </div>
                    <div class="shop pt-3 pb-4 px-4">
                        <RouterLink :to="{
                            path: '/news',
                            query: {
                                title: '共生共赢，美丽地球',
                                content: new4,
                                date: '2024-12-01'
                            }
                        }"><button type="button">立刻了解</button></RouterLink>
                    </div>
                </div>
            </div>
        </div>

        <div class="M365">
            <picture>
                <source media="(min-width:1084px)" srcset="../image/二手big.png">
                <source>
                <img src="../image/二手.png" alt="">
            </picture>
            <div class="text py-5 px-md-5">
                <h2>闲置焕新，物尽其用</h2>
                <div class="words mb-4">让闲置物品找到新归宿，资源循环利用，共创绿色环保的美好生活。</div>
                <div class="group">
                    <RouterLink to="/classify"><button>立即体验</button></RouterLink>
                    <a href="javascript:;" class="explain">买卖方便，再创价值 ></a>
                </div>
            </div>
        </div>

        <h3 class="carbonH3">记录每一步，减少每一克，碳足迹从现在改变未来。🌳</h3>
        <div class="M365 carbon">
            <picture>
                <source media="(min-width:1084px)" srcset="../image/carbon.jpg">
                <source>
                <img src="../image/carbon.small.png" alt="">
            </picture>
        </div>
        <RouterLink to="/carbon" class="carbonComp"><button>立即计算</button></RouterLink>

        <!-- 关注Microsoft -->
        <div class="follow">
            <span>关注Microsoft</span>
            <ul>
                <li class="wechat"><a href="javascript:;"><img src="../image/wechat-logo.png" alt=""></a></li>
                <li><a href="javascript:;"><img src="../image/weibo-logo.png" alt=""></a></li>
            </ul>
        </div>

        <!--  返回页首 -->
        <div class="back">
            <a href="#mycarousel"><button style="
    border: 0;
"><span class="icon-arrow-up2 text"></span>返回页首</button></a>
        </div>

        <!-- 底部1 -->
        <div class="bottom clearfix">
            <div class="bottom1">
                <dl>
                    <dt>账号</dt>
                    <dd>
                        <RouterLink to="/register">注册新账号</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">登录账号</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">修改账号信息</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">登出账号</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">注销账号</RouterLink>
                    </dd>
                </dl>
                <dl>
                    <dt>二手商城</dt>
                    <dd>
                        <RouterLink to="/add">发布商品</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/classify">浏览商品</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">搜索</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/login">购物车</RouterLink>
                    </dd>
                </dl>
                <dl>
                    <dt>环保</dt>
                    <dd>
                        <RouterLink to="/classify">购买环保商品</RouterLink>
                    </dd>
                    <dd>
                        <RouterLink to="/classify">计算碳足迹</RouterLink>
                    </dd>
                </dl>

                <dl>
                    <dt>新闻</dt>
                    <dd><a href="javascript:;">环保新闻</a></dd>
                    <dd><a href="javascript:;">能源新闻</a></dd>
                    <dd><a href="javascript:;">志愿者新闻</a></dd>
                    <dd><a href="javascript:;">碳排放新闻</a></dd>
                    <dd><a href="javascript:;">森林新闻</a></dd>
                </dl>
                <dl>
                    <dt>关于我们</dt>
                    <dd><a href="javascript:;">关注我们</a></dd>
                    <dd><a href="javascript:;">意见反馈</a></dd>
                    <dd><a href="javascript:;">环保社区</a></dd>
                    <dd><a href="javascript:;">故事</a></dd>
                    <dd><a href="javascript:;">加入我们</a></dd>
                </dl>



            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
const new1 = `
<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在这个日新月异的时代，城市不仅是经济活动的核心，更是承载梦想的沃土。随着科技的发展与环保意识的提升，我们的城市正在经历一场前所未有的变革。在这场变革中，绿色成为了主旋律，“绿意融城，筑梦未来”不仅是一句口号，更是一种行动、一份责任，它为我们勾画出一个人与自然和谐共生的美好图景。</p>
  
  <p><strong>绿色：是城市的生命力</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在传统的城市化进程中，快速的发展往往伴随着环境的压迫和资源的消耗。然而，随着环保理念的兴起和技术的进步，城市的未来不再是钢铁与混凝土的丛林，而是自然与人文相融合的生态绿洲。绿色建筑、城市绿化、环保交通，这些元素正在重新定义我们对城市的认知。</p>
  
  <strong>“绿意融城”，意味着将大自然的元素融入城市的每一处角落。</strong>
  <p> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp从绿化带到屋顶花园，从城市公园到街头绿地，绿色空间如同城市的肺，带来清新的空气与宁静的心灵。随着智慧城市的建设，绿色不仅仅局限于自然景观，它融入了城市的能源系统、交通网络、垃圾处理等各个方面，推动着城市迈向可持续发展的未来。</p>
  
  <p><strong>融合：是人类与自然的和谐共生</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp现代城市不仅要满足人们对物质和生活质量的需求，更要注重人与自然的关系。绿色城市的建设是一种生态意识的觉醒，它强调在发展的过程中不忽视环境保护，不仅要有经济的繁荣，还要有生态的平衡。</p>

  <p><strong>梦想：是未来的美好愿景</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp“筑梦未来”，是对美好城市的期许，也是对未来人类生活方式的描绘。未来的城市将更加智能化、绿色化和人性化。随着科技的发展，数字化技术将引领城市的变革，智能化的基础设施和绿色建筑将成为城市的标配，而人们的生活方式也将更加注重环保与可持续性。</p>

  <p><strong>结语</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp“绿意融城，筑梦未来”不仅是时代的召唤，更是每个城市居民共同的责任。绿色城市，代表着人与自然的和谐共生，代表着我们对未来的承诺。在这片绿意盎然的土地上，梦想不再遥远，它们随着一座座绿色城市的崛起，正一步步走向现实。让我们一起为未来的美好生活而努力，为地球的可持续发展贡献力量。</p>
`;
const new2 = `
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在大自然的怀抱中，树木是生命的象征。它们不仅仅是地球的“呼吸器”，更是生态系统中不可或缺的一部分。在这个日益工业化的世界里，树木的作用愈发重要，它们以其静默的方式为地球提供了无尽的支持。</p>
  
  <p><strong>树木：大自然的生命源泉</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp树木是地球上最古老的生命之一，它们通过光合作用为我们提供了氧气。每一棵树，都像是大自然的氧气工厂，每年释放出大量的氧气，为人类和其他生物提供必需的空气。而在大气中的二氧化碳，它们通过吸收和转化，帮助减少温室气体，起到了缓解气候变化的作用。</p>

  <p><strong>千分氧：树木的巨大贡献</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp每棵树木，每年都会释放出大量的氧气。据科学研究显示，一棵成熟的树木可以为三到四个人提供足够的氧气。根据“千分氧”这一概念，我们能够更直观地理解树木对地球生态系统的巨大贡献。如果我们想象将氧气分为千分之一，那么每棵树木所贡献的千分之一氧气，对于人类的生存和发展至关重要。</p>

  <p><strong>树木与环境：人类未来的希望</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp树木不仅仅是氧气的制造者，它们还是地球生态系统的重要调节器。树木帮助防止土壤侵蚀，保持水土的平衡，保护生物多样性。随着城市化的不断推进，我们愈加意识到绿化和植树造林对于环境的保护和气候调节的重要性。树木不仅是生态环境的守护者，它们还是城市未来可持续发展的关键组成部分。</p>

  <p><strong>我们的责任：共筑绿色家园</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在现代化的进程中，树木却面临着前所未有的威胁。城市扩张、工业污染、气候变化等因素使得树木生长的空间日益减少。我们每个人都应该承担起保护树木的责任。无论是通过参与植树活动，还是推动绿色政策，树木的保护和绿化工作都应成为每个人的责任。每一棵树都代表着我们对未来的承诺，每一片绿叶都象征着希望与生机。</p>

  <p><strong>结语：树木的未来，地球的未来</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp树木是我们与地球共同的财富，它们的存在不仅让我们的空气更加清新，也让我们的世界更加美丽。只有当我们尊重并保护自然，树木才能茁壮成长，地球才能更加绿色、宜居。树木是地球的生命线，也是人类未来发展的关键。让我们一同保护树木，守护我们共同的家园。</p>
`;
const new3 = `
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp随着全球环境问题的日益严峻，能源转型已成为全球发展的重要议题。绿色、低碳的未来是我们共同的追求，而电动化的发展正为这一梦想的实现提供了强大的动力。电动未来，绿色前行，这不仅是对科技创新的回应，更是对人类未来生活方式的深刻思考。</p>
  
  <p><strong>电动化：绿色革命的先锋</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp电动化技术，特别是在交通领域的应用，正在以前所未有的速度改变我们的世界。电动汽车（EV）已逐渐成为市场的主流，成为城市出行和长途旅行的新选择。与传统燃油车相比，电动汽车不仅零排放，减少了空气污染，还大大降低了碳足迹，成为推动绿色发展的重要力量。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp从特斯拉到各大传统汽车厂商，全球汽车产业正掀起一场电动化革命。随着电池技术的不断突破和充电基础设施的逐步完善，电动汽车的续航里程越来越长，充电更加便捷，消费者的选择空间也日益增大。电动汽车不仅在减少碳排放方面发挥着积极作用，它们还推动了清洁能源的应用，为未来的绿色社会奠定了基础。</p>

  <p><strong>清洁能源：电动未来的基石</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp电动化不仅仅是车辆的转型，它还需要与清洁能源的广泛应用相结合。太阳能、风能、水能等可再生能源的普及是实现绿色出行的关键。电动汽车的电力来源如果依赖于传统的燃煤发电，那么其环保效益将大打折扣。因此，只有当清洁能源成为主要电力来源时，电动未来才会真正成为绿色、可持续的解决方案。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在许多国家，电网结构正朝着更加智能和绿色的方向发展。智能电网技术的应用能够优化能源分配，减少能源浪费，为电动汽车提供清洁电力。同时，随着风能和太阳能发电技术的成熟，电动汽车与绿色电力的结合，将进一步推动低碳交通系统的发展。</p>

  <p><strong>绿色前行：构建可持续的未来</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp“绿色前行”不仅仅是指电动汽车的普及，它还涉及到人类社会各个方面的绿色转型。从绿色建筑到绿色生产，再到绿色消费，整个社会都在为可持续发展贡献力量。电动化与绿色建筑、绿色工业、绿色农业等紧密结合，构成了一个全面的绿色发展系统。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp除了交通领域，电动化在家庭和工业领域也展现出了巨大的潜力。例如，电动家居设备和电动工具的普及，推动了能源效率的提升和碳排放的减少。同时，智能家居系统的广泛应用，使得人们能够更加精确地控制家庭能源的使用，进一步降低碳排放。</p>

  <p><strong>挑战与机遇：向绿色未来进发</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp尽管电动化已经取得了显著的进展，但要实现完全的电动未来，仍然面临许多挑战。首先，电池的生产和回收仍是一个亟待解决的问题。电池的原材料开采和生产过程对环境造成的影响，需要我们进一步优化和改进。此外，电动汽车的普及也要求基础设施的建设和政策的支持。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp然而，这些挑战并不意味着停滞不前，反而是推动创新的动力。随着技术的不断进步和政策的不断支持，电动未来将会变得更加清晰可见。全球绿色转型的浪潮正在加速，而电动化无疑将是其中最为关键的一环。</p>

  <p><strong>结语：电动未来，绿色前行</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp电动未来，绿色前行。未来的城市将不再被尾气污染笼罩，清新的空气和安静的道路将成为城市生活的新常态。电动汽车将成为出行的主力，绿色能源将成为主导动力。通过技术创新和全球合作，我们正在一步步迈向一个更加绿色、低碳、可持续的未来。电动化的进程，不仅是对未来环境的保护，也是对全人类可持续发展的承诺。</p>`
const new4 = `
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在全球化日益加深的今天，人类社会与自然环境之间的关系正面临着前所未有的挑战。随着资源的过度消耗、环境的持续恶化，地球的生态平衡受到威胁。然而，我们依然充满希望，因为“共生共赢，美丽地球”的理念为我们指引了一条通往可持续发展的道路。</p>
  
  <p><strong>共生共赢：人与自然的和谐共处</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp共生共赢的理念源自于大自然中生物之间的相互依存关系。正如森林中的树木、动物与微生物相互依赖，生态系统中的每一个生命体都在发挥着不可或缺的作用。人类社会也应当以这样的智慧与自然相处，从而实现人与自然的和谐共生。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp在人类与自然的关系中，传统的“征服自然”观念逐渐被“尊重与合作”的新理念所取代。我们不再是自然界的主宰，而是其中的一员，应该与大自然共享资源、共同进步。通过发展绿色经济、循环经济，推动低碳科技，企业和个人不仅能够获得经济效益，还能促进环境保护，实现经济与生态的双赢。</p>

  <p><strong>可持续发展：绿色经济的推动力</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp可持续发展的核心是资源的合理利用与保护。随着环境问题的加剧，越来越多的国家和地区已经意识到，传统的“以发展为唯一目标”的经济模式已不可持续。绿色经济，作为应对全球环境危机的重要路径，正在成为各国发展的新趋势。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp绿色经济的核心在于低碳、环保、高效利用资源。例如，绿色建筑、清洁能源、可再生能源的应用，都大大减少了对环境的负担。同时，绿色经济也为经济增长带来了新的动力，创造了大量新的就业机会。通过创新技术、绿色生产和绿色消费，我们可以在保持经济增长的同时，减轻对生态环境的压力。</p>

  <p><strong>美丽地球：我们共同的家园</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp地球是我们唯一的家园，它为我们提供了生命所需的一切：空气、水源、食物、能源。然而，随着人类活动的扩展，我们也对地球造成了巨大的压力。大气污染、水污染、土地退化、物种灭绝等问题层出不穷，生态系统面临着严峻的挑战。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp但美丽的地球依然充满着生命的奇迹。为了保护我们的家园，越来越多的环保组织和个人开始行动起来，致力于环境保护、自然资源的可持续利用。每一份绿色行动，都是对地球的关爱与呵护。</p>

  <p><strong>共生共赢的未来：人人参与，绿色转型</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp共生共赢、美丽地球不仅是一个理想，它需要全球每个人的共同参与。无论是政府、企业还是普通公民，每个人都应该在自己的生活中做出绿色选择，推动社会的绿色转型。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp政府应该制定更加严格的环保法规和政策，引导企业和个人朝着低碳、环保的方向前进。企业则需要通过创新技术和绿色管理，减少资源浪费，降低污染排放。每一位公民也应在日常生活中注重节约能源、减少废弃物的产生，推动社会的环保意识不断提高。</p>

  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp未来的世界，将是人与自然、人与人之间共同发展的世界。只有当全球各国在共生共赢的理念指引下共同努力时，我们才能创造一个更加美丽的地球，一个可持续发展的家园。</p>

  <p><strong>结语：迈向绿色未来</strong></p>
  <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp共生共赢，美丽地球。这不仅仅是一个理念，更是一种行动的召唤。我们每个人都应该承担起环保责任，为地球的未来贡献自己的力量。无论是通过推动绿色经济，还是通过改变个人的生活方式，只有大家共同参与，才能实现人与自然、人与人之间的和谐共生，走向更加美丽、可持续的未来。</p>
`;
</script>
<style scoped>
 @import url(../css/bootstrap.min.css);
 @import url(../css/index.css);
.index{
    margin-top: -30px;
}
</style>