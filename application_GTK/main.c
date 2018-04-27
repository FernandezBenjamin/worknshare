#include <stdlib.h>
#include <gtk/gtk.h>

void creer_file_selection();
void recuperer_chemin(GtkWidget *bouton, GtkWidget *file_selection);

int chemin;

int main(int argc, char **argv)
{
    GtkWidget *pWindow;
    GtkWidget *pTable;
    GtkWidget *pButton[3];
    GtkWidget *dialog;

    gtk_init(&argc, &argv);

    pWindow = gtk_window_new(GTK_WINDOW_TOPLEVEL);
    gtk_window_set_title(GTK_WINDOW(pWindow), "Les GtkTable");
    g_signal_connect(G_OBJECT(pWindow), "destroy", G_CALLBACK(gtk_main_quit), NULL);

    /* Creation et insertion de la table 3 lignes 2 colonnes */
    pTable=gtk_table_new(2,2,TRUE);
    gtk_container_add(GTK_CONTAINER(pWindow), GTK_WIDGET(pTable));

    /* Creation des boutons */
    pButton[0]= gtk_button_new_with_label("Chemin \n des fichiers XML");
    pButton[1]= gtk_button_new_with_label("Chemin des répertoires \n fusions");
    pButton[2]= gtk_button_new_with_label("Fusion");


    gtk_table_attach(GTK_TABLE(pTable), pButton[0],
        0, 1, 0, 2,
        GTK_FILL , GTK_FILL,
        0, 50);
    gtk_table_attach(GTK_TABLE(pTable), pButton[1],
        1, 2, 0, 2,
        GTK_FILL , GTK_FILL,
        0, 50);
    gtk_table_attach(GTK_TABLE(pTable), pButton[2],
        0, 2, 2, 3,
        GTK_FILL , GTK_EXPAND,
        0, 0);

    g_signal_connect(G_OBJECT(pButton[1]), "clicked", G_CALLBACK(creer_file_selection), NULL);

    chemin = gtk_file_selection_get_filename(GTK_FILE_SELECTION (file_selection) );

    dialog = gtk_message_dialog_new(GTK_WINDOW(file_selection),
    GTK_DIALOG_MODAL,
    GTK_MESSAGE_INFO,
    GTK_BUTTONS_OK,
    "Vous avez choisi :\n%s", chemin);

    gtk_widget_show_all(pWindow);

    gtk_dialog_run(GTK_DIALOG(dialog));
    gtk_widget_destroy(dialog);
    gtk_widget_destroy(file_selection);
    gtk_main();

    return EXIT_SUCCESS;
}

void creer_file_selection()
{
    GtkWidget *selection;

    selection = gtk_file_selection_new( g_locale_to_utf8( "Sélectionnez un fichier", -1, NULL, NULL, NULL) );
    gtk_widget_show(selection);

    //On interdit l'utilisation des autres fenêtres.
    gtk_window_set_modal(GTK_WINDOW(selection), TRUE);

    g_signal_connect(G_OBJECT(GTK_FILE_SELECTION(selection)->ok_button), "clicked", G_CALLBACK(recuperer_chemin), selection );

    g_signal_connect_swapped(G_OBJECT(GTK_FILE_SELECTION(selection)->cancel_button), "clicked", G_CALLBACK(gtk_widget_destroy), selection);
}

void recuperer_chemin(GtkWidget *bouton, GtkWidget *file_selection)
{
    chemin = gtk_file_selection_get_filename(GTK_FILE_SELECTION (file_selection) );

    dialog = gtk_message_dialog_new(GTK_WINDOW(file_selection),
    GTK_DIALOG_MODAL,
    GTK_MESSAGE_INFO,
    GTK_BUTTONS_OK,
    "Vous avez choisi :\n%s", chemin);

    gtk_dialog_run(GTK_DIALOG(dialog));
    gtk_widget_destroy(dialog);
    gtk_widget_destroy(file_selection);
}
