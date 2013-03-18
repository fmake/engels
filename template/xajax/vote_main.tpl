                        <input type="hidden" name="action" value="interview_right" />
                        <input type="hidden" name="interview_id" value="{interview_id}" />
                            [[for vopr in Quest ]]
                                [[if Cook ]]
                                        [[if vopr.url]]
                                        [[else]]
                                            <div class="var">
                                                <div class="value">{vopr.caption}</div>
                                                <div class="color" wdt="{vopr.stat}"></div>
                                                <div class="number">{vopr.stat}</div>
                                                <div class="cl"></div>
                                            </div>
                                        [[endif]]
                                [[else]]
                                        [[if vopr.url]]
                                            <label>
                                                <input type="radio" [[if loop.first]]checked="checked"[[endif]] name="response" value="{vopr.id}" />&nbsp;&nbsp;<span><a href="{vopr.url}">{vopr.caption}</a></span>
                                            </label>
                                            <br />
                                        [[else]]
                                            <label>
                                                <input type="radio" [[if loop.first]]checked="checked"[[endif]] name="response" value="{vopr.id}" />&nbsp;&nbsp;<span>{vopr.caption}</span>
                                            </label>
                                            <br />
                                        [[endif]]
                                [[endif]]
                            [[endfor]]
                        [[if not Cook ]]
                            <button class="butt" type="submit">
                                <span><span><span>Проголосовать</span></span></span>
                            </button>
                        [[elseif Do !=1 ]]
                            <button class="butt hide_me" type="button" onclick="location.href='{site_obj.getLinkPage(7030)}'; return false">
                                <span><span><span>Архив голосований</span></span></span>
                            </button>
                        [[endif]]
