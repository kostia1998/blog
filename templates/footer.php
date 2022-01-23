</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Menu</div>
    <ul>
        <li><a href="/">Home page</a></li>

        <? if ($user !== null && $user->isAdmin()): ?>
            <li><a href="/articles/add">Creating a new article</a></li>
        <? endif ?>

    </ul>
</td>
</tr>
<tr>
    <td class="footer" colspan="2">All rights reserved (c) Pavlo Vovchenko</td>
</tr>
</table>

</body>
</html>
