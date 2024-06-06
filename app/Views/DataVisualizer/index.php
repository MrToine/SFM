<?php $class = ""; ?>
<h1 class="page-title">DataAnalyzer: Liste des tables</h1>
<nav class="navigation">
    <ul>
        <?php foreach($data['table'] as $modelName => $modelData): ?>
            <?php $class = $modelName; ?>
            <li><a href="?r=/DataVisualizer/<?= $modelName; ?>" class="item-link <?= $data['table_name'] == $class ? 'active':''; ?>"><?php echo $modelName; ?></a></li>
        <?php endforeach; ?>
        <li><a href="?r=/DataVisualizer/add" class="item-link-add">+</a></li>
    </ul> 
</nav>
<a href="" class="btn btn-create">Créer une entrée</a>
<?php foreach($data['table'] as $modelName => $modelData): ?>
    <?php if($modelName == $class): ?>
        <table class="table">
            <tr>
                <th class="th"><?= $modelName; ?></th>
            </tr>
            <?php foreach($modelData as $field => $value): ?>
                <tr>
                    <td class="td"><?= $value->id; ?></td>
                    <td class="td"><?= $value->name; ?></td>
                    <td class="td"><?= $value->content; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endforeach; ?>