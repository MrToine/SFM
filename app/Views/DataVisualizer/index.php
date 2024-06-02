<h1 class="page-title">DataAnalyzer: Liste des tables</h1>
<nav class="navigation">
    <ul>
        <?php foreach($data as $modelName => $modelData): ?>
            <li><a href="" class="item-link"><?php echo $modelName; ?></a></li>
        <?php endforeach; ?>
    </ul> 
</nav>
<table>
    <?php foreach($data as $modelName => $modelData): ?>
        <?php foreach($modelData as $field => $value): ?>
            <td><?= $value; ?></td>
        <?php endforeach; ?>
    <?php endforeach; ?>
</table>
